<?php

namespace App\Filament\Resources\KorekduaResource\Pages;

use App\Filament\Resources\KorekduaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKorekdua extends EditRecord
{
    protected static string $resource = KorekduaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
