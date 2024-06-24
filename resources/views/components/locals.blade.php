<x-filament::dropdown>
    <x-slot name="trigger">
{{--        <x-filament::icon-button icon="heroicon-o-language" />--}}
        {{ $this->local }}
    </x-slot>

    <x-filament::dropdown.list>

        <x-filament::dropdown.list.item wire:click.live="setLocal('ar');">
            Arabic
        </x-filament::dropdown.list.item>
        <x-filament::dropdown.list.item wire:click.live="setLocal('en');">
            English
        </x-filament::dropdown.list.item>
    </x-filament::dropdown.list>
</x-filament::dropdown>
