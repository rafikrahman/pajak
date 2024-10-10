<?php

namespace App\Filament\Resources\SetorbbmResource\Pages;

use App\Filament\Resources\SetorbbmResource;
use App\Models\User;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Container\Attributes\Auth;

class CreateSetorbbm extends CreateRecord
{
    protected static string $resource = SetorbbmResource::class;

    // protected function getRedirectUrl(): string
    // {
    //     $name = Auth::user()->name;
    //     Notification::make()
    //         ->success()
    //         ->title('Setorbbm Created By ' . $name)
    //         ->body('New Pos Has Been Saved')
    //         ->actions([
    //             Action::make('view')
    //                 ->url(fn() => 'setorpbb/show/'.$this->record->id, shouldOpenInNewTab:true)
    //         ])
    //         ->sendToDatabase(User::whereNot('id', auth()->user()->id)->get());

    //     return $this->previousUrl ?? $this->getResource()::getUrl('index');
    // }
}
