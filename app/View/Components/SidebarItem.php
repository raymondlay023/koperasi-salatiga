<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarItem extends Component
{
    public $href;
    public $svgPath;
    public $isActive;

    /**
     * Create a new component instance.
     */
    public function __construct($href = "#", $svgPath = '', $isActive = false)
    {
        $this->href = $href;
        $this->svgPath = $svgPath;
        $this->isActive = $isActive;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-item');
    }
}
