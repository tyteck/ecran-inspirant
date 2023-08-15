<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Enums\Colors;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navigation extends Component
{
    public array $navigableRoutes = [
        'index' => 'Accueil',
        'help' => 'Aide',
    ];

    /**
     * Create a new component instance.
     */
    public function __construct(public Colors $color, public string $activeRoute)
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navigation');
    }
}
