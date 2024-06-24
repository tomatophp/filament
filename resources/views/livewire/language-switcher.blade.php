<x-filament::dropdown>
    <x-slot name="trigger">
        <x-filament::icon-button icon="heroicon-o-language" />
    </x-slot>

    <x-filament::dropdown.list>
        <x-filament::dropdown.list.item wire:click="updateLocale('ar')">
            Arabic
        </x-filament::dropdown.list.item>
        <x-filament::dropdown.list.item wire:click="updateLocale('en')">
            English
        </x-filament::dropdown.list.item>
    </x-filament::dropdown.list>
</x-filament::dropdown>
