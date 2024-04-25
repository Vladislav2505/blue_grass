<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class ActionButtons extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Model $model,
        public string $urlParam = '',
        public bool $isUpdatable = true,
        public bool $isDeletable = true,
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.table.action-buttons');
    }
}
