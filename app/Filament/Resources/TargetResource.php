<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TargetResource\Pages;
use App\Filament\Resources\TargetResource\RelationManagers;
use App\Models\Target;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Relations\Relation;
use Filament\Forms\Get;
use Filament\Forms\Components\Select;
use Filament\Forms\Set;
use Illuminate\Support\Collection;
use App\Models\Korekdua;
use App\Models\Koreksatu;
use App\Models\korektiga;
use Filament\Support\RawJs;
use Filament\Forms\Components\Fieldset;

use Auth;

class TargetResource extends Resource
{
    protected static ?string $model = Target::class;

    protected static ?string $navigationLabel = 'Target';

    protected static ?string $navigationIcon = 'heroicon-o-cursor-arrow-ripple';

    protected static ?string $navigationGroup = 'Manage Unit';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Administrasi')
                    ->schema([
                    Forms\Components\Select::make('uptd_id')
                        ->relationship('uptd', 'name', modifyQueryUsing: fn (Builder $query) => $query->where('user_id', auth()->id()))
                        ->required(),

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
                    ])->columns(4),

                Fieldset::make('Nilai')
                    ->schema([
                    Forms\Components\TextInput::make('nilaitarget')
                        ->label('Nilai Target')
                        ->mask(RawJs::make('$money($input)'))
                        ->stripCharacters(',')
                        ->numeric()
                        ->required(),
                    Forms\Components\DatePicker::make('tahun'),
                    Forms\Components\Select::make('ket')
                        ->options([
                            'Murni' => 'Murni',
                            'Perubahan' => 'Perubahan',
                        ])
                        ->required(),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query){
                if (Auth::user()->role == 'uptd') {
                    $userId = Auth::user()->id;
                    $query->where('uptd_id', $userId);
                }
            })

            ->columns([
                Tables\Columns\TextColumn::make('uptd.name')
                    ->label('Nama UPTD'),
                Tables\Columns\TextColumn::make('koreksatu.code')
                    ->label('Kode Rek'),
                Tables\Columns\TextColumn::make('koreksatu.name')
                    ->label('Nama Rek')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nilaitarget')
                    ->label('Nilai Target')
                    ->money('IDR', locale: 'id'),
                Tables\Columns\TextColumn::make('tahun')
                    ->label('Tahun')
                    ->dateTime('D, d-m-Y'),
                Tables\Columns\TextColumn::make('ket')
                    ->label('Keterangan'),
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
            'index' => Pages\ListTargets::route('/'),
            'create' => Pages\CreateTarget::route('/create'),
            'edit' => Pages\EditTarget::route('/{record}/edit'),
        ];
    }

    //Uptd mengunci tampilan Target di halaman product
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('uptd', function($query){
            $query->where('user_id', auth()->id());
        });
    }


}
