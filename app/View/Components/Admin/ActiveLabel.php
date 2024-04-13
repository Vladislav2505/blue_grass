<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActiveLabel extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public bool $isActive = true
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.table.active-label');
    }
}
