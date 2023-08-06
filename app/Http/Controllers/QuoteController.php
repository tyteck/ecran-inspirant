<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Services\InspirationFont;
use App\Services\InspirationPicture;

class QuoteController extends Controller
{
    public function get()
    {
        // get resolution
        $resolutionWidth = 828;
        $resolutionHeight = 1792;

        // get random color

        // get quote
        $text = Quote::getOne();

        // create inspiration picture
        $picture = InspirationPicture::create($resolutionWidth, $resolutionHeight, fake()->hexColor());

        // add text
        InspirationFont::create($picture, $text)
            ->alignMiddleCenter()
            ->applyToImage()
        ;

        // return image
        return $picture->get()->response();
    }
}
