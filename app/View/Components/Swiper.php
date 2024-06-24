<?php

namespace App\View\Components;

use Closure;
use Ijpatricio\Mingle\Concerns\InteractsWithMingles;
use Ijpatricio\Mingle\Contracts\HasMingles;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Swiper extends Component implements HasMingles
{
    use InteractsWithMingles;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $type="gallery",
        public ?bool $horizontal=false,
        public ?array $images=[],
        public ?int $items=1,
        public bool $navigation=false
    )
    {
        //
    }

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
//
//    /**
//     * Get the view / contents that represent the component.
//     */
//    public function render(): View|Closure|string
//    {
//        return view('components.swiper');
//    }
}
