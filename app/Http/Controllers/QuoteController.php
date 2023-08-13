<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Services\FontPathSelector;
use App\Services\GetPresetFrom;
use App\Services\InspirationFont;
use App\Services\InspirationPicture;

class QuoteController extends Controller
{
    public const DEFAULT_RESOLUTION_WIDTH = 828;
    public const DEFAULT_RESOLUTION_HEIGHT = 1792;

    public function get(?string $presetOrWitdh = null, string $height = null)
    {
        // get random font
        $fontPath = (new FontPathSelector())->getOneFont();

        // get quote
        $text = Quote::getOne();

        $resolutionWidth = self::DEFAULT_RESOLUTION_WIDTH;
        $resolutionHeight = self::DEFAULT_RESOLUTION_HEIGHT;

        if ($this->areDimensionsValid($presetOrWitdh, $height)) {
            $resolutionWidth = intval($presetOrWitdh);
            $resolutionHeight = intval($height);
        }

        if ($presetOrWitdh !== null) {
            $preset = GetPresetFrom::from($presetOrWitdh)->get();
            if ($preset !== null) {
                $resolutionWidth = $preset->width();
                $resolutionHeight = $preset->height();
            }
        }

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

    protected function areDimensionsValid(string $width = null, string $height = null): bool
    {
        if ($width === null || $height === null) {
            return false;
        }

        return is_numeric($width) && is_numeric($height) && intval($width) > 0 && intval($height) > 0;
    }
}
