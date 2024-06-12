<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardCard extends Component
{

    public $svgPath;
    public $title;
    public $value;
    public $iconColor;

    /**
     * Create a new component instance.
     */
    public function __construct($svgPath, $title, $value, $iconColor = 'orange')
    {
        $this->svgPath = $svgPath;
        $this->title = $title;
        $this->value = $value;
        $this->iconColor = $iconColor;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard-card');
    }
}
