<?php

namespace App\Filament\Pbbkb\Resources;

use App\Filament\Pbbkb\Resources\SetorbbmResource\Pages;
use App\Filament\Pbbkb\Resources\SetorbbmResource\RelationManagers;
use App\Models\Setorbbm;
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
use Filament\Forms\Get;
use Illuminate\Support\Collection;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\Summarizers\Count;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Support\RawJs;
use Filament\Tables\Filters\SelectFilter;
use Filament\Support\Enums\Alignment;
use Filament\Tables\Actions\ExportAction;
use App\Filament\Actions\Exports\ExportColumn;
use App\Filament\Exports\SetorbbmExporter;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Actions\Exports\Enums\ExportFormat;

class SetorbbmResource extends Resource
{
    protected static ?string $model = Setorbbm::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-currency-dollar';

    protected static ?string $navigationGroup = 'Manage PBB-KB';

    protected static ?string $navigationLabel = 'Setoran PBB-KB';

    public static function form(Form $form): Form
    {
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

                        Forms\Components\Select::make('perusahaan_id')
                            ->label('Perusahaan')
                            ->searchable()
                            ->relationship('perusahaan', 'name')
                            ->required(),

                        Forms\Components\Select::make('transportir_id')
                            ->label('Transportir')
                            ->relationship('transportir', 'name'),

                        Forms\Components\Select::make('konsumen_id')
                            ->label('Konsumen')
                            ->relationship('konsumen', 'name'),

                    ])->columns(3),

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
                            ->numeric()
                            ->required(),

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
                    ->label('Foto Bukti Pembayaran')
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

                Tables\Columns\TextColumn::make('perusahaan.name'),

                Tables\Columns\TextColumn::make('regency.name')
                    ->label('Kabupaten/Kota'),

                Tables\Columns\TextColumn::make('koreksatu.inisial')
                    ->label('Rekening')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('volume')
                    ->numeric()
                    ->suffix(' ltr')
                    ->alignment(Alignment::End),

                Tables\Columns\TextColumn::make('nilai')
                    ->summarize(Sum::make())
                    ->label('Jumlah')
                    ->numeric(locale: 'id')
                    ->prefix('Rp ')
                    ->alignment(Alignment::End),

                Tables\Columns\TextColumn::make('tglsetor')
                    ->label('Tanggal')
                    ->sortable(),

                Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                    ->label('Bukti Setor')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('Perusahaan')
                        ->relationship('perusahaan', 'name')
                        ->searchable()
                        ->preload()
                        ->label('Perusahaan')
                        ->indicator('Regency'),

                SelectFilter::make('Regency')
                    ->relationship('regency', 'name')
                        ->searchable()
                        ->preload()
                        ->label('Kabupaten/Kota')
                        ->indicator('Setoranpbb'),

                Filter::make('tglsetor')
                        ->form([
                            DatePicker::make('created_from')
                                ->label('Mulai'),
                            DatePicker::make('created_until')
                                ->label('Sampai')
                                ->default(now()),
                        ])->columns(2)
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(SetorbbmExporter::class)
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
            'index' => Pages\ListSetorbbms::route('/'),
            'create' => Pages\CreateSetorbbm::route('/create'),
            'edit' => Pages\EditSetorbbm::route('/{record}/edit'),
        ];
    }
}
