<?php

namespace App\View\Components\Admin\Show;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class DeleteButton extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Model $model
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.show.delete-button');
    }
}
