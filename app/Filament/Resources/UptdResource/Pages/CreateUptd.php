<?php

namespace App\Filament\Resources\UptdResource\Pages;

use App\Filament\Resources\UptdResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateUptd extends CreateRecord
{
    protected static string $resource = UptdResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug'] = Str::slug($data['name']);
        $data['user_id'] = auth()->id();

        return $data;
    }

}
