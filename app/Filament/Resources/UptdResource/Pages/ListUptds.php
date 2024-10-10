<?php

namespace App\Filament\Resources\UptdResource\Pages;

use App\Filament\Resources\UptdResource;
use App\Models\Uptd;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;


class ListUptds extends ListRecords
{
    protected static string $resource = UptdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    // public function getHeader(): ?View
    // {
    //     $data = Actions\CreateAction::make();
    //     return view('filament.custom.upload-file', compact('data'));
    // }

    // public $file = '';

    // public function save(){
    //     Uptd::create([

    //     ]);
    // }
}
