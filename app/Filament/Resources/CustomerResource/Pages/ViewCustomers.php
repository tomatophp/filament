<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ManageRecords;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Table;
use TomatoPHP\FilamentApi\Traits\InteractWithAPI;

class ViewCustomers extends ViewRecord
{
    use InteractWithAPI;

    public static function getFilamentAPIResource(): ?string
    {
        return \App\Http\Resources\CustomerResource::class;
    }


    protected static string $resource = CustomerResource::class;
}
