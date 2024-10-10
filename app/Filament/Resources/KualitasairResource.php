<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KualitasairResource\Pages;
use App\Filament\Resources\KualitasairResource\RelationManagers;
use App\Models\Kualitasair;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class KualitasairResource extends Resource
{
    protected static ?string $model = Kualitasair::class;

    protected static ?string $navigationLabel = 'Kualitas Air';

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    protected static ?string $navigationGroup = 'Manage PAP';

    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')->numeric(),
                Forms\Components\TextInput::make('level'),
                Forms\Components\TextInput::make('nilai')->numeric(),
                Forms\Components\Textarea::make('uraian'),
                Forms\Components\TextInput::make('action')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode'),
                Tables\Columns\TextColumn::make('level'),
                Tables\Columns\TextColumn::make('nilai')
                    ->money('IDR', locale: 'id'),
                Tables\Columns\TextColumn::make('uraian'),
                Tables\Columns\TextColumn::make('action'),
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
            'index' => Pages\ListKualitasairs::route('/'),
            'create' => Pages\CreateKualitasair::route('/create'),
            'edit' => Pages\EditKualitasair::route('/{record}/edit'),
        ];
    }


}
