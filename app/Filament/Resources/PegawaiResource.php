<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PegawaiResource\Pages;
use App\Filament\Resources\PegawaiResource\RelationManagers;
use App\Models\Pegawai;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Fieldset;


class PegawaiResource extends Resource
{
    protected static ?string $model = Pegawai::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Manage Unit';

    protected static ?string $navigationLabel = 'Pegawai';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Administrasi Pegawai')
                    ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required(),
                    Forms\Components\TextInput::make('nip')
                        ->numeric(),
                    Forms\Components\Select::make('gender')
                        ->options([
                            'Laki-Laki' => 'Laki-Laki',
                            'Perempuan' => 'Perempuan',
                        ])
                        ->required(),
                    Forms\Components\Select::make('golongan')
                        ->options([
                            'Tidak Ada' => 'Tidak Ada',
                            'Ia' => 'Ia', 'Ib' => 'Ib', 'Ic' => 'Ic', 'Id' => 'Id',
                            'IIa' => 'IIa', 'IIb' => 'IIb', 'IIc' => 'IIc', 'IId' => 'IId',
                            'IIIa' => 'IIIa', 'IIIb' => 'IIIb', 'IIIc' => 'IIIc', 'IIId' => 'IIId',
                            'IVa' => 'IVa', 'IVb' => 'IVb', 'IVc' => 'IVc', 'IVd' => 'IVd',
                        ])
                        ->required(),
                    Forms\Components\Select::make('status')
                        ->options([
                            'PNS' => 'PNS',
                            'P3K' => 'P3K',
                            'Tekon' => 'Tekon',
                            'Honorer' => 'Honorer',
                        ])
                        ->required(),
                    Forms\Components\Select::make('statusjabatan')
                        ->options([
                            'Definitif' => 'Definitif',
                            'Pejabat Sementara' => 'Pejabat Sementara',
                        ])
                        ->required(),
                    Forms\Components\TextInput::make('masakerja'),
                    Forms\Components\Select::make('jabatan_id')
                        ->relationship('jabatan', 'name')
                        ->required(),
                    Forms\Components\Select::make('uptd_id')
                        ->relationship('uptd', 'name',
                        modifyQueryUsing: fn (Builder $query) => $query->where('user_id', auth()->id()))
                        ->required(),
                ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('nip'),
                Tables\Columns\TextColumn::make('jabatan.name'),
                Tables\Columns\TextColumn::make('uptd.name'),
                Tables\Columns\TextColumn::make('golongan'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('statusjabatan'),
                Tables\Columns\TextColumn::make('masakerja'),
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
            'index' => Pages\ListPegawais::route('/'),
            'create' => Pages\CreatePegawai::route('/create'),
            'edit' => Pages\EditPegawai::route('/{record}/edit'),
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
