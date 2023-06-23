<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ViewComponent extends Component
{
    public $data1;
    /**
     * Create a new component instance.
     */
    public function __construct($data1)
    {
        $this->data1 = $data1;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.view-component');
    }
}
