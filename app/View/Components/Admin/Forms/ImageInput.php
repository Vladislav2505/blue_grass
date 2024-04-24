<?php

namespace App\View\Components\Admin\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ImageInput extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $inputName,
        public string $inputLabel,
        public string $inputAccept = '',
        public bool $isMultiple = false,
        public Collection|array|string $inputValue = [],
        public bool $isRequired = false,
    ) {
        if (is_string($this->inputValue)) {
            $this->inputValue = [$inputValue];
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.forms.image-input');
    }
}
