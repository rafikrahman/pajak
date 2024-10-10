<?php

namespace App\Filament\Pbbkb\Resources;

use App\Filament\Pbbkb\Resources\SetorprResource\Pages;
use App\Filament\Pbbkb\Resources\SetorprResource\RelationManagers;
use App\Models\Setorpr;
use App\Models\Korekdua;
use App\Models\Koreksatu;
use App\Models\korektiga;
use App\Models\Province;
use App\Models\Regency;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Get;
use Illuminate\Support\Collection;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Support\RawJs;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class SetorprResource extends Resource
{
    protected static ?string $model = Setorpr::class;

    protected static ?string $navigationLabel = 'Setoran PR';

    protected static ?string $navigationIcon = 'heroicon-o-document-currency-dollar';

    protected static ?string $navigationGroup = 'Manage Pajak Rokok';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Administrasi')
                    ->schema([
                        Forms\Components\TextInput::make('noreg')
                            ->label('No. Suart Keputusan'),

                        Forms\Components\TextInput::make('title')
                            ->label('Judul')
                            ->required(),
                        Forms\Components\TextArea::make('keterangan')
                            ->label('Keterangan'),

                        Forms\Components\Select::make('pegawai_id')
                            ->label('Pegawai')
                            ->relationship('pegawai', 'name'),

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

                Fieldset::make('Daerah')
                    ->schema([
                        Forms\Components\Select::make('province_id')
                            ->label('Provinsi')
                            ->searchable()
                            ->options(Province::query()
                            ->pluck('name', 'id'))
                            ->required()
                            ->live(),

                        Forms\Components\Select::make('regency_id')
                            ->label('Kabupaten/Kota')
                            ->searchable()
                            ->options(fn (Get $get): Collection => Regency::query()
                                ->where('province_id', $get('province_id'))
                                ->pluck('name', 'id'))
                            ->live(),
                    ])->columns(3),

                Fieldset::make('Hitungan')
                    ->schema([
                        Forms\Components\TextInput::make('volume')
                            ->label('Volume')
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->numeric(),

                        Forms\Components\TextInput::make('nilai')
                            ->label('Jumlah Uang')
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->numeric()
                            ->required(),

                        Forms\Components\DatePicker::make('tglsetor')
                            ->label('Tanggal Setor')
                            ->required(),
                    ])->columns(3),
                Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                    ->label('Bukti Transfer')
                    ->directory('image_setorpr'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('index')
                    ->label('#')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('noreg')
                    ->label('No. SK'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('regency.name')
                    ->label('Kabupaten')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('koreksatu.name')
                    ->label('Kode Rek')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('volume')->numeric(),
                Tables\Columns\TextColumn::make('nilai')
                    ->summarize(Sum::make())
                    ->label('Jumlah')
                    ->numeric(locale: 'id')
                    ->prefix('Rp '),
                Tables\Columns\TextColumn::make('tglsetor')
                    ->label('Tanggal'),
                Tables\Columns\TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                    ->label('Bukti Setor')
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListSetorprs::route('/'),
            'create' => Pages\CreateSetorpr::route('/create'),
            'edit' => Pages\EditSetorpr::route('/{record}/edit'),
        ];
    }
}
