<?php

namespace App\Filament\Resources\UptdResource\Pages;

use App\Filament\Resources\UptdResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUptd extends EditRecord
{
    protected static string $resource = UptdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
