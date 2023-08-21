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
    public const DEFAULT_PRESET = 'iphone11';
    public const SMALLEST_PRESET = 'sd';
    public const BIGGEST_PRESET = '8k';
    public const WATERMARK_TEXT_SIZE = 48;

    protected int $defaultWidth;
    protected int $smallestWidth;
    protected int $biggestWidth;
    protected int $defaultHeight;
    protected int $smallestHeight;
    protected int $biggestHeight;

    public function __construct()
    {
        $preset = GetPresetFrom::from(self::DEFAULT_PRESET)->get();
        $this->defaultWidth = $preset->width();
        $this->defaultHeight = $preset->height();

        $smallestPreset = GetPresetFrom::from(self::SMALLEST_PRESET)->get();
        $this->smallestWidth = $smallestPreset->width();
        $this->smallestHeight = $smallestPreset->height();

        $biggestPreset = GetPresetFrom::from(self::BIGGEST_PRESET)->get();
        $this->biggestWidth = $biggestPreset->width();
        $this->biggestHeight = $biggestPreset->height();
    }

    public function get(?string $presetOrWidth = null, string $height = null)
    {
        // get random font
        $fontPath = (new FontPathSelector())->getOneFont();

        // get quote
        $text = Quote::getOne();

        // setting default dimensions
        $resolutionWidth = $this->defaultWidth;
        $resolutionHeight = $this->defaultHeight;

        // if preset or width
        if (is_numeric($presetOrWidth) && $this->checkWidth($presetOrWidth)) {
            $resolutionWidth = intval($presetOrWidth);
        }

        if (is_numeric($height) && $this->checkHeight($height)) {
            $resolutionHeight = intval($height);
        }

        if ($presetOrWidth !== null) {
            $preset = GetPresetFrom::from($presetOrWidth)->get();
            if ($preset !== null) {
                $resolutionWidth = $preset->width();
                $resolutionHeight = $preset->height();
            }
        }

        // create inspiration picture
        $picture = InspirationPicture::create($resolutionWidth, $resolutionHeight, fake()->hexColor());

        // add text
        $mainText = InspirationFont::create(picture: $picture, fontPath: $fontPath, text: $text)
            ->alignMiddleCenter()
            ->applyToImage()
        ;

        $watermarkTextSize = self::WATERMARK_TEXT_SIZE;
        if ($watermarkTextSize > $mainText->textSize()) {
            $watermarkTextSize = $mainText->textSize() - 8;
        }
        // add Watermark
        InspirationFont::create(picture: $picture, fontPath: $fontPath, text: config('app.domain'), textSize: $watermarkTextSize)
            ->alignBottomRight()
            ->applyToImage()
        ;

        // return image
        return $picture->get()->response();
    }

    protected function checkWidth(string $presetOrWidth): bool
    {
        return $this->smallestWidth <= intval($presetOrWidth) && intval($presetOrWidth) <= $this->biggestWidth;
    }

    protected function checkHeight(string $height): bool
    {
        return $this->smallestHeight <= intval($height) && intval($height) <= $this->biggestHeight;
    }
}
