<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListTopicComponent extends Component
{
    public $topic;
    public $user;
    public $comment;
    /**
     * Create a new component instance.
     */
    public function __construct($topic, $user, $comment)
    {
        $this->topic = $topic;
        $this->user = $user;
        $this->comment = $comment;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.list-topic-component');
    }
}
