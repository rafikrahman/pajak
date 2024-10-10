<?php

namespace App\Filament\Resources\KoreksatuResource\Pages;

use App\Filament\Resources\KoreksatuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKoreksatu extends EditRecord
{
    protected static string $resource = KoreksatuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
