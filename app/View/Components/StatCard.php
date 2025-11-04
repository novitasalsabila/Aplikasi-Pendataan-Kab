<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StatCard extends Component
{
    public $color;
    public $title;
    public $value;

    /**
     * Create a new component instance.
     */
    public function __construct($color = 'blue', $title = '', $value = 0)
    {
        $this->color = $color;
        $this->title = $title;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.stat-card');
    }
}
