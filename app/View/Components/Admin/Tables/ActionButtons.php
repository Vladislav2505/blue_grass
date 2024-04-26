<?php

namespace App\View\Components\Admin\Tables;

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
        public bool $isUpdatable = false,
        public bool $isDeletable = true,
        public bool $isViewable = false,
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.tables.action-buttons');
    }
}
