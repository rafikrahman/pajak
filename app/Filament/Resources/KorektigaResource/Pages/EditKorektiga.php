<?php

namespace App\Filament\Resources\KorektigaResource\Pages;

use App\Filament\Resources\KorektigaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKorektiga extends EditRecord
{
    protected static string $resource = KorektigaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
