<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Services\FontPathSelector;
use App\Services\GetPresetFrom;
use App\Services\InspirationFont;
use App\Services\InspirationPicture;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public const DEFAULT_RESOLUTION_WIDTH = 828;
    public const DEFAULT_RESOLUTION_HEIGHT = 1792;

    public function get(Request $request, ?string $presetOrWitdh)
    {
        // get random font
        $fontPath = (new FontPathSelector())->getOneFont();

        // get quote
        $text = Quote::getOne();

        $preset = GetPresetFrom::from($presetOrWitdh)->get();

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

    protected function getResolutionWidth(string $presetOrWitdh): int
    {
        if (is_numeric($presetOrWitdh)) {
            return intval($presetOrWitdh);
        }

        $preset = GetPresetFrom::from($presetOrWitdh)->get();
        if ($preset !== null) {
            return $preset->width();
        }

        return self::DEFAULT_RESOLUTION_WIDTH;
    }

    protected function getResolutionHeight(string $presetOrWitdh): int
    {
        if (is_numeric($presetOrWitdh)) {
            return intval($presetOrWitdh);
        }

        $preset = GetPresetFrom::from($presetOrWitdh)->get();
        if ($preset !== null) {
            return $preset->width();
        }

        return self::DEFAULT_RESOLUTION_WIDTH;
    }
}
