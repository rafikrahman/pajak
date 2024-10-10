<?php

namespace App\Filament\Pbbkb\Resources\SetorprResource\Pages;

use App\Filament\Pbbkb\Resources\SetorprResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSetorprs extends ListRecords
{
    protected static string $resource = SetorprResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
