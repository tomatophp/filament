<?php

namespace App\Forms\Components;


use App\Livewire\LanguageSwitcher;
use Closure;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Contracts\CanBeLengthConstrained;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Livewire;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;

class Translation extends TextInput
{
    protected string $view = 'components.translation';
    private ?array $locals;


    /**
     * @return array<mixed>
     */
    public function getValidationRules(): array
    {
        $rules = [
            'array'
        ];

        return $rules;
    }


    public function setUp(): void
    {
        parent::setUp();
        $this->live();
        $this->default([
            "ar" => "",
            "en" => ""
        ]);
        $this->mutateDehydratedState(function ($state) {
            dd($state);
        });
        $this->suffixActions([
            Action::make('locals')
                ->view('components.locals'),
        ]);
    }

    public function locals(array $local): static
    {
        $this->locals = $local;
        return $this;
    }
}
