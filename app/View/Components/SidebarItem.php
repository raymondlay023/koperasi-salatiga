<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class SidebarItem extends Component
{
    public $href;
    public $svgPath;
    public $isActive;

    /**
     * Create a new component instance.
     */
    public function __construct($href = "#", $svgPath = '')
    {
        $this->href = $href;
        $this->svgPath = $svgPath;
        $this->isActive = $this->checkIfActive($href);
    }

    /**
     * Determine if the sidebar is active
     */
     private function checkIfActive($href)
     {
        // Extract route name from the href
        $routeName = collect(Route::getRoutes())->filter(function ($route) use ($href) {
            return url($route->uri()) === url($href);
        })->first()?->getName();

        return $routeName && Route::currentRouteName() === $routeName;
     }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-item');
    }
}
