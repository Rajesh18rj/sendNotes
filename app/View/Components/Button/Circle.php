<?php

namespace App\View\Components\Button;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Circle extends Component
{
    public function render(): View
    {
        return view('components.button.circle');
    }
}
