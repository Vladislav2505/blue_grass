<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AuthForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $formAction,
        public string $formTitle,
        public string $formLabel = '',
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.auth-form');
    }
}
