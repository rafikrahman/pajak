<?php

namespace App\Filament\Pbbkb\Resources\SetorprResource\Pages;

use App\Filament\Pbbkb\Resources\SetorprResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSetorpr extends EditRecord
{
    protected static string $resource = SetorprResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
