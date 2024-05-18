<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NumberInput extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $inputName,
        public ?string $inputValue = '',
        public string $inputLabel = '',
        public string $inputPlaceholder = '',
        public string $minNumber = '',
        public string $maxNumber = '',
        public bool $isRequired = false,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.number-input');
    }
}
