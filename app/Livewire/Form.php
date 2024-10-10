<?php

namespace App\Livewire;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;


class Form extends Component implements HasForms
{
    use InteractsWithForms;

    protected function getFormSchema(): array 
    {
        return [
                Card::make()->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(100),
                
                TextInput::make('email')
                    ->email()
                    ->label('Email Adress')
                    ->required()
                    ->maxLength(100),

                TextInput::make('password')
                    ->password()
                    ->required()
                    ->same('passwprdConfirmation')
                    ->dehydrated(fn ($state) => filled($state))
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->minLength(8),

                TextInput::make('passwordConfirmation')
                    ->password()
                    ->label('Password Confirmation')
                    ->required()
                    ->dehydrated(false)
                    ->minLength(8),
            ])
        ];
    }

    public function render()
    {
        return view('livewire.form');
    }
}
