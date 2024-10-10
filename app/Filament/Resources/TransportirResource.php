<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransportirResource\Pages;
use App\Filament\Resources\TransportirResource\RelationManagers;
use App\Models\Transportir;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Korekdua;
use App\Models\Koreksatu;
use App\Models\korektiga;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use Filament\Forms\Get;
use Illuminate\Support\Collection;


class TransportirResource extends Resource
{
    protected static ?string $model = Transportir::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationGroup = 'Manage PBB-KB';

    protected static ?int $navigationSort = 22;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('iden')
                ->label('Surat Ijin'),

                Forms\Components\TextInput::make('name')
                ->label('Nama Perusahaan'),

                Forms\Components\TextInput::make('alamat')
                ->label('Alamat'),

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

                Forms\Components\Select::make('district_id')
                    ->label('Kecamatan')
                    ->searchable()
                    ->options(fn (Get $get): Collection => District::query()
                        ->where('regency_id', $get('regency_id'))
                        ->pluck('name', 'id'))
                    ->live(),

                Forms\Components\TextInput::make('namekontak')
                    ->label('Nama Kontak'),

                Forms\Components\TextInput::make('ponsel')
                    ->label('No. Ponsel')
                    ->tel(),

                Forms\Components\TextInput::make('emailkontak')
                    ->label('Email Kontak')
                    ->email(),

                    Forms\Components\Select::make('status')
                    ->options([
                        'Aktif' => 'Aktif',
                        'Tidak Aktif' => 'Tidak Aktif'
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('index')
                    ->label('#')
                    ->rowIndex(),

                //Tables\Columns\TextColumn::make('iden'),
                //Tables\Columns\TextColumn::make('noreg'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Perusahaan')
                    ->searchable(),
                //Tables\Columns\TextColumn::make('alamat'),
                Tables\Columns\TextColumn::make('province.name')
                ->label('Provinsi'),
                //Tables\Columns\TextColumn::make('regency.name')
                //->label('Kabupaten/Kota'),
                //Tables\Columns\TextColumn::make('district.name'),
                //Tables\Columns\TextColumn::make('email'),
                //Tables\Columns\TextColumn::make('website'),
                Tables\Columns\TextColumn::make('namekontak')
                    ->label('Nama Kontak'),
                //Tables\Columns\TextColumn::make('ponsel')
                //->label('No. HP'),
                //Tables\Columns\TextColumn::make('emailkontak'),
                Tables\Columns\TextColumn::make('status'),
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
            'index' => Pages\ListTransportirs::route('/'),
            'create' => Pages\CreateTransportir::route('/create'),
            'edit' => Pages\EditTransportir::route('/{record}/edit'),
        ];
    }


}
