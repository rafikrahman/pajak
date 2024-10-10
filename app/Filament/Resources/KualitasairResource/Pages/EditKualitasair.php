<?php

namespace App\Filament\Resources\KualitasairResource\Pages;

use App\Filament\Resources\KualitasairResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKualitasair extends EditRecord
{
    protected static string $resource = KualitasairResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
