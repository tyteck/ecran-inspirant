<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Colors;
use App\Models\Quote;

class CreateImage
{
    protected InspirationPicture $picture;

    private function __construct(
        protected int $width,
        protected int $height,
        protected Colors $color,
    ) {
        // get random font
        $fontPath = (new FontPathSelector())->getOneFont();

        // get quote
        $text = Quote::getOne();

        // create inspiration picture
        $this->picture = InspirationPicture::create($this->width, $this->height, $this->color->interColor());

        // add text
        InspirationFont::create(picture: $this->picture, fontPath: $fontPath, text: $text)
            ->alignMiddleCenter()
            ->applyToImage()
        ;
    }

    public static function create(...$params)
    {
        return new static(...$params);
    }

    public function get(): InspirationPicture
    {
        return $this->picture;
    }
}
