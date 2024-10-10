<?php

namespace App\Filament\Pbbkb\Resources\PerusahaanResource\Pages;

use App\Filament\Pbbkb\Resources\PerusahaanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPerusahaans extends ListRecords
{
    protected static string $resource = PerusahaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
