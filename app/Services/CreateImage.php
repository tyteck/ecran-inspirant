<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Quote;

class CreateImage
{
    protected InspirationPicture $picture;

    private function __construct(
        protected int $width,
        protected int $height,
        protected string $bgColor,
        protected string $fontColor,
    ) {
        // get random font
        $fontPath = (new FontPathSelector())->getOneFont();

        // get quote
        $text = Quote::getOne();

        // create inspiration picture
        $this->picture = InspirationPicture::create(width: $this->width, height: $this->height, backgroundColor: $bgColor);

        // add text
        InspirationFont::create(picture: $this->picture, fontPath: $fontPath, text: $text, textColor: $fontColor)
            ->alignMiddleCenter()
            ->applyToImage()
        ;
    }

    public static function create(int $width, int $height, string $bgColor, string $fontColor)
    {
        return new static($width, $height, $bgColor, $fontColor);
    }

    public function get(): InspirationPicture
    {
        return $this->picture;
    }
}
