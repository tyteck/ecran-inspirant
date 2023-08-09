<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    protected array $emotes = ['🤔', '😌', '😎', '😊'];
    // ces couleurs sont celles de tailwind
    // et elles doivent egalement se retrouver dans
    // le fichier tailwind.config.js
    protected array $colors = ['gray', 'blue', 'red', 'pink', 'emerald'];

    public function show(): View|Factory
    {
        $emote = $this->emotes[array_rand($this->emotes)];

        $color = $this->colors[array_rand($this->colors)];

        $pageTitle = 'Ecran inspirant ' . $emote;

        return view('welcome', compact('pageTitle', 'color'));
    }
}
