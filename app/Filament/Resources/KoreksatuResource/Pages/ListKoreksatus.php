<?php

namespace App\Filament\Resources\KoreksatuResource\Pages;

use App\Filament\Resources\KoreksatuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKoreksatus extends ListRecords
{
    protected static string $resource = KoreksatuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
