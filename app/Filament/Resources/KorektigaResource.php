<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KorektigaResource\Pages;
use App\Filament\Resources\KorektigaResource\RelationManagers;
use App\Models\Korektiga;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class KorektigaResource extends Resource
{
    protected static ?string $model = Korektiga::class;

    protected static ?string $navigationIcon = 'heroicon-o-code-bracket';

    protected static ?string $navigationGroup = 'Kode Rekening';

    protected static ?int $navigationSort = 53;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code'),
                Forms\Components\TextInput::make('name'),
                Forms\Components\Select::make('korekdua_id')
                    ->relationship('korekdua', 'name')
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('korekdua.code'),
                Tables\Columns\TextColumn::make('korekdua.name'),
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListKorektigas::route('/'),
            'create' => Pages\CreateKorektiga::route('/create'),
            'edit' => Pages\EditKorektiga::route('/{record}/edit'),
        ];
    }


}
