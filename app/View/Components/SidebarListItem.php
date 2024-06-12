<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarListItem extends Component
{
    public $svgPath;
    public $title;
    public $submenus;
    public $menuId;

    /**
     * Create a new component instance.
     */
    public function __construct($svgPath, $title, $submenus = [], $menuId = '')
    {
        $this->svgPath = $svgPath;
        $this->title = $title;
        $this->submenus = $submenus;
        $this->menuId = $menuId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-list-item');
    }
}
