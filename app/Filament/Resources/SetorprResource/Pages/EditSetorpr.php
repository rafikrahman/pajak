<?php

namespace App\Filament\Resources\SetorprResource\Pages;

use App\Filament\Resources\SetorprResource;
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
