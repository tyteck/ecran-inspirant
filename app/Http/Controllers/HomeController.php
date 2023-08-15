<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\Color;
use App\Services\CreateImage;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    use Color;

    protected array $emotes = ['🤔', '😌', '😎', '😊'];

    public function show(): View|Factory
    {
        $description = "Tu voudrais avoir un fond d'écran original et inspirant.
            Tu voudrais qu'il change tous les jours sans intervention de ta part ? 
            Ecran-inpirant est là pour ca et en plus c'est gratuit.";
        $emote = $this->emotes[array_rand($this->emotes)];

        $color = $this->randomColor();

        $width = 400;
        $height = intval(round($width * 1.77777, 0)); // linkedin vertical image ratio

        $inspirationPicture = CreateImage::create($width, $height, $color)->get();
        $inspirationPicture->save(public_path('images/welcome.jpg'));

        $pageTitle = 'Ecran inspirant ' . $emote;

        return view('welcome', compact('pageTitle', 'color', 'description', 'width', 'height'));
    }
}
