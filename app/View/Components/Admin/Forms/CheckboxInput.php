<?php

namespace App\View\Components\Admin\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CheckboxInput extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $inputName,
        public string $inputLabel,
        public bool $inputIsChecked = false,
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.forms.checkbox-input');
    }
}
