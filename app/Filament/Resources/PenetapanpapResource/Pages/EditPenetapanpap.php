<?php

namespace App\Filament\Resources\PenetapanpapResource\Pages;

use App\Filament\Resources\PenetapanpapResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenetapanpap extends EditRecord
{
    protected static string $resource = PenetapanpapResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
