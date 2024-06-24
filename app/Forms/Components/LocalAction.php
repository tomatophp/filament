<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Actions\Action;

class LocalAction extends Action
{
    #[On('language-switched')]
    public function changeLocal(string $local)
    {
        app()->setLocale($local);
    }
}
