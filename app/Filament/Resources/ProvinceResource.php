<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProvinceResource\Pages;
use App\Filament\Resources\ProvinceResource\RelationManagers;
use App\Models\Province;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class ProvinceResource extends Resource
{
    protected static ?string $model = Province::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-americas';

    protected static ?string $navigationGroup = 'Daftar Daerah';

    protected static ?int $navigationSort = 61;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
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
            'index' => Pages\ListProvinces::route('/'),
            'create' => Pages\CreateProvince::route('/create'),
            'edit' => Pages\EditProvince::route('/{record}/edit'),
        ];
    }


}
