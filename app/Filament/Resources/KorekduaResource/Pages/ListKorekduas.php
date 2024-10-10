<?php

namespace App\Filament\Resources\KorekduaResource\Pages;

use App\Filament\Resources\KorekduaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKorekduas extends ListRecords
{
    protected static string $resource = KorekduaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
