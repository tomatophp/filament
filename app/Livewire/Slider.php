<?php

namespace App\Livewire;

use Ijpatricio\Mingle\Concerns\InteractsWithMingles;
use Ijpatricio\Mingle\Contracts\HasMingles;
use Livewire\Component;

class Slider extends Component implements HasMingles
{
    use InteractsWithMingles;

    public ?string $type="gallery";
    public ?bool $horizontal=false;
    public ?array $images=[];
    public ?int $items=1;
    public bool $navigation=false;

    public function component(): string
    {
        return 'resources/js/Slider.js';
    }

    public function mingleData()
    {
        return [
            'type' => $this->type,
            'position' => $this->horizontal ? 'horizontal' : 'vertical',
            'images' => $this->images,
            'items' => $this->items,
            'navigation' => $this->navigation
        ];
    }
}
