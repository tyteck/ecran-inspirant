<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Services\FontPathSelector;
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

        // get random font
        $fontPath = (new FontPathSelector())->getOneFont();

        // get quote
        $text = Quote::getOne();

        // create inspiration picture
        $picture = InspirationPicture::create($resolutionWidth, $resolutionHeight, fake()->hexColor());

        // add text
        InspirationFont::create(picture: $picture, fontPath: $fontPath, text: $text)
            ->alignMiddleCenter()
            ->applyToImage()
        ;

        // add Watermark
        InspirationFont::create(picture: $picture, fontPath: $fontPath, text: config('app.domain'), textSize: 48)
            ->alignBottomRight()
            ->applyToImage()
        ;

        // return image
        return $picture->get()->response();
    }
}
