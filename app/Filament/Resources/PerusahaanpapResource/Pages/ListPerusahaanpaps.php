<?php

namespace App\Filament\Resources\PerusahaanpapResource\Pages;

use App\Filament\Resources\PerusahaanpapResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPerusahaanpaps extends ListRecords
{
    protected static string $resource = PerusahaanpapResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
