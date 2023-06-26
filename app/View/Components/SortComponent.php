<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SortComponent extends Component
{
    public $name;
    public $param;

    /**
     * Create a new component instance.
     */
    public function __construct($name, $param)
    {
        $this->name = $name;
        $this->param = $param;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sort-component');
    }
}
