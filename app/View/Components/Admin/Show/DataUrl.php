<?php

namespace App\View\Components\Admin\Show;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DataUrl extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $dataLabel,
        public string $dataValue,
        public string $url,
        public array $params,
    ) {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.show.data-url');
    }
}
