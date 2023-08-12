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
        $description = "Tu voudrais avoir un fond d'écran original et inspirant.
            Tu voudrais qu'il change tous les jours sans intervention de ta part ? 
            Ecran-inpirant est là pour ca et en plus c'est gratuit.";
        $emote = $this->emotes[array_rand($this->emotes)];

        $color = Colors::random();

        $width = 500;
        $height = 650;

        $inspirationPicture = CreateImage::create($width, $height, $color)->get();
        $inspirationPicture->save(public_path('images/welcome.jpg'));

        $pageTitle = 'Ecran inspirant ' . $emote;

        return view('welcome', compact('pageTitle', 'color', 'description', 'width', 'height'));
    }
}
