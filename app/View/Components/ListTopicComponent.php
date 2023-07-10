<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListTopicComponent extends Component
{
    public $topic;
    /**
     * Create a new component instance.
     */
    public function __construct($topic)
    {
        $this->topic = $topic;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.list-topic-component');
    }
}
