<?php

namespace App\Filament\Resources\SetorbbmResource\Pages;

use App\Filament\Resources\SetorbbmResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Columns\Column;

class ListSetorbbms extends ListRecords
{
    protected static string $resource = SetorbbmResource::class;

    protected function getHeaderActions(): array
    {
        // $queryString = request()->getQueryString();
        // $decodeQueryString = urldecode(request()->getQueryString());
        return [
            // Actions\Action::make('export')
            //     ->url(url('/export?'.$decodeQueryString)),
            Actions\CreateAction::make()
            ->label('+ Setor BBM'),
        ];

    }
}
