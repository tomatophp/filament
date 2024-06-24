<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class LanguageSwitcher extends Component
{
    public ?string $activeLocale =null;

    public function updateLocale(string $locale)
    {
        $this->activeLocale = $locale;
    }

    public function render()
    {
        return view('livewire.language-switcher');
    }
}
