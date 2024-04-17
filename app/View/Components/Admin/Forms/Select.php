<?php

namespace App\View\Components\Admin\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $selectLabel,
        public string $selectName,
        public Collection|array $selectOptions,
        public Collection|array|int|null $selectedOptions = null,
        public bool $isMultiple = false,
        public bool $isRequired = false,
    )
    {
        if (is_int($this->selectedOptions)) {
            $this->selectedOptions = collect($this->selectedOptions);
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.forms.select');
    }
}
