<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class table extends Component
{
    public $list, $headers;

    /**
     * Create a new component instance.
     */
    public function __construct($list, $headers)
    {
        $this->list = $list;
        $this->headers = $headers;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table');
    }
}
