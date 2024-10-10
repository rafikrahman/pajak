<?php

namespace App\Filament\Resources\PenetapanpapResource\Pages;

use App\Filament\Resources\PenetapanpapResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenetapanpaps extends ListRecords
{
    protected static string $resource = PenetapanpapResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
