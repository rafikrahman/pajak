<?php

namespace App\Filament\Resources\KorektigaResource\Pages;

use App\Filament\Resources\KorektigaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKorektigas extends ListRecords
{
    protected static string $resource = KorektigaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
