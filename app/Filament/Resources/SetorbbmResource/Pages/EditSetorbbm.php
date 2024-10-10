<?php

namespace App\Filament\Resources\SetorbbmResource\Pages;

use App\Filament\Resources\SetorbbmResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSetorbbm extends EditRecord
{
    protected static string $resource = SetorbbmResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
