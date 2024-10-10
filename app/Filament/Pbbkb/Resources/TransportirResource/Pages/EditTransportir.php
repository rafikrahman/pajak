<?php

namespace App\Filament\Pbbkb\Resources\TransportirResource\Pages;

use App\Filament\Pbbkb\Resources\TransportirResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransportir extends EditRecord
{
    protected static string $resource = TransportirResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
