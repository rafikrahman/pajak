<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenetapanpapResource\Pages;
use App\Filament\Resources\PenetapanpapResource\RelationManagers;
use App\Models\Penetapanpap;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Fieldset;
use Filament\Support\RawJs;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Forms\Get;
use App\Models\Korekdua;
use App\Models\Koreksatu;
use App\Models\korektiga;
use App\Models\Kualitasair;
use Illuminate\Support\Collection;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Filament\Actions\Exports\ExportColumn;
use Filament\Forms\Components\Repeater;
use Filament\Infolists\Components\Section;
use Filament\Forms\Components\Component;
use Filament\Forms\Set;



class PenetapanpapResource extends Resource
{
    protected static ?string $model = Penetapanpap::class;

    protected static ?string $navigationLabel = 'Penetapan';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Manage PAP';


    protected static ?int $navigationSort = 6;


    public static function form(Form $form): Form
    {
        $kualitasairs = Kualitasair::get();

        return $form
            ->schema([
                Fieldset::make('Administrasi')
                    ->schema([
                        Forms\Components\TextInput::make('iden')
                            ->label('Surat Keputusan'),

                        Forms\Components\TextInput::make('noreg')
                            ->label('No. Suart Keputusan'),

                        Forms\Components\Select::make('pegawai_id')
                            ->label('Pegawai')
                            ->relationship('pegawai', 'name'),

                    ])->columns(3),

                Fieldset::make('Perusahaan')
                    ->schema([

                        Forms\Components\Select::make('perusahaanpap_id')
                            ->label('Perusahaan')
                            ->searchable()
                            ->relationship('perusahaanpap', 'name')
                            ->required(),

                        Forms\Components\Select::make('uptd_id')
                            ->label('UPTD')
                            ->relationship('uptd', 'name')
                            ->required(),

                    ])->columns(2),

                Fieldset::make('Kode Rekening')
                    ->schema([
                        Forms\Components\Select::make('koreksatu_id')
                            ->label('Nama Kode Rek I')
                            ->options(Koreksatu::query()
                            ->pluck('name', 'id'))
                            ->required()
                            ->live(),

                        Forms\Components\Select::make('korekdua_id')
                            ->label('Nama Kode Rek II')
                            ->options(fn (Get $get): Collection => Korekdua::query()
                                ->where('koreksatu_id', $get('koreksatu_id'))
                                ->pluck('name', 'id'))
                            ->live(),

                        Forms\Components\Select::make('korektiga_id')
                            ->label('Nama Kode Rek III')
                            ->options(fn (Get $get): Collection => korektiga::query()
                                ->where('korekdua_id', $get('korekdua_id'))
                                ->pluck('name', 'id'))
                            ->live(),
                    ])->columns(3),


                    Forms\Components\Repeater::make('Tagihan')
                    ->schema([

                        Forms\Components\Select::make('kualitasair_id')
                            ->label('Kualitas Air')
                            ->relationship('kualitasair', 'level')
                            ->required(),

                        Forms\Components\TextInput::make('volumepap')
                            ->label('Volume')
                            ->numeric()
                            ->required()
                            ->default(1)
                            ->minValue(1)
                            ->columnSpan(2)
                            ->reactive()
                            ->afterStateUpdated(fn ($state, Set $set, Get $get) => $set('total_amount', $state*$get('unit_amount'))),

                        Forms\Components\TextInput::make('nilaipap')
                        ->integer()
                        // Read-only, because it's calculated
                        ->readOnly()
                        ->prefix('Rp')
                        ->afterStateHydrated(function (Get $get, Set $set) {
                            self::updateNilai($get, $set);
                        }),

                        Forms\Components\DatePicker::make('tglsetor')
                            ->label('Tanggal Setor')
                            ->required(),
                            Forms\Components\FileUpload::make('image')
                            ->label('Foto Meteran Air'),

                    ])->columns(3),

            ]);
    }

    // This function updates totals based on the selected products and quantities
public static function updateNilai(Get $get, Set $set): void
{
    // Retrieve all selected products and remove empty rows
    $selectedKualitasairs = collect($get('tagihanKualitasairs'))->filter(fn($item) => !empty($item['penetapanpap']) && !empty($item['volume']));

    // Retrieve prices for all selected products
    $nilais = Kualitasair::find($selectedKualitasairs->pluck('kualitasair_id'))->pluck('nilai', 'id');

    // Calculate subtotal based on the selected products and quantities
    $nilai = $selectedKualitasairs->reduce(function ($nilai, $Kualitasair) use ($nilais) {
        return $nilai = ($nilais[$kualitasair['kualitasair_id']] * $penetapanpap['volume']);
    }, 0);

    // Update the state with the new values
    $set('nilai', number_format($nilai, 0, '.', ''));
    //$set('nilai', number_format($nilai, 0, '.', ''));
}



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenetapanpaps::route('/'),
            'create' => Pages\CreatePenetapanpap::route('/create'),
            'edit' => Pages\EditPenetapanpap::route('/{record}/edit'),
        ];
    }

    //Uptd mengunci tampilan Pegawai di halaman product
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('uptd', function($query){
            $query->where('user_id', auth()->id());
        });
    }


}
