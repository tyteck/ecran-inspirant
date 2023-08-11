<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\Colors;
use App\Services\CreateImage;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    protected array $emotes = ['🤔', '😌', '😎', '😊'];
    // ces couleurs sont celles de tailwind
    // et elles doivent egalement se retrouver dans
    // le fichier tailwind.config.js
    protected array $colors = ['gray', 'orange', 'red', 'green', 'blue', 'purple', 'pink', 'emerald', 'rose'];

    public function show(): View|Factory
    {
        $emote = $this->emotes[array_rand($this->emotes)];

        $color = Colors::random();

        $inspirationPicture = CreateImage::create(500, 650, $color)->get();
        $inspirationPicture->save(public_path('images/welcome.jpg'));

        $pageTitle = 'Ecran inspirant ' . $emote;

        return view('welcome', compact('pageTitle', 'color'));
    }
}
