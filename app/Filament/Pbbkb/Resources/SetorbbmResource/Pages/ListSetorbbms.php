<?php

namespace App\Filament\Pbbkb\Resources\SetorbbmResource\Pages;

use App\Filament\Pbbkb\Resources\SetorbbmResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSetorbbms extends ListRecords
{
    protected static string $resource = SetorbbmResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
