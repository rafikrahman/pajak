<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UptdResource\Pages;
use App\Filament\Resources\UptdResource\RelationManagers;
use App\Models\Uptd;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Fieldset;



class UptdResource extends Resource
{
    protected static ?string $model = Uptd::class;

    protected static ?string $navigationIcon = 'heroicon-o-printer';

    protected static ?string $navigationGroup = 'Manage Unit';

    protected static ?string $navigationLabel = 'UPTD';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Administrasi Pegawai')
                    ->schema([
                    Forms\Components\TextInput::make('code')
                        ->numeric()
                        ->required(),
                    Forms\Components\TextInput::make('inisial'),
                    Forms\Components\TextInput::make('name')
                        ->required(),
                    Forms\Components\TextInput::make('contact')
                        ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\TextColumn::make('inisial'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->button(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
            // ->headerActions([
            //     Tables\Actions\CreateAction::make(),
            // ]);
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
            'index' => Pages\ListUptds::route('/'),
            'create' => Pages\CreateUptd::route('/create'),
            'edit' => Pages\EditUptd::route('/{record}/edit'),
        ];
    }

    //Uptd mengunci tampilan user di halaman utpds
    // public static function getEloquentQuery(): Builder
    // {
    //     return parent::getEloquentQuery()->where('user_id', auth()->id());
    // }

}
