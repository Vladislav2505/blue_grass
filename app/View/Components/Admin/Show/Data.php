<?php

namespace App\View\Components\Admin\Show;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Data extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $dataLabel,
        public string $dataValue,
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.show.data');
    }
}
