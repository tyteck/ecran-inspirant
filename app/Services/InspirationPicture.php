<?php

declare(strict_types=1);

namespace App\Services;

use Intervention\Image\Facades\Image;
use Intervention\Image\Image as InterventionImage;

class InspirationPicture
{
    public const DEFAULT_WIDTH = 500;
    public const DEFAULT_HEIGHT = 500;
    public const DEFAULT_BACKGROUND_COLOR = '#CCCCFF';
    public const DEFAULT_MIME = 'image/jpeg';

    protected InterventionImage $picture;

    private function __construct(
        protected int $width = self::DEFAULT_WIDTH,
        protected int $height = self::DEFAULT_HEIGHT,
        protected string $backgroundColor = self::DEFAULT_BACKGROUND_COLOR,
    ) {
        $this->picture = Image::canvas($this->width, $this->height, $this->backgroundColor)
            ->encode('jpg', 80)
        ;
    }

    public static function create(...$params)
    {
        return new static(...$params);
    }

    public function addText(string $text): self
    {
        $this->picture->text(
            $text,
            $this->textPosition()['x'],
            $this->textPosition()['y'],
            function ($font): void {
                // $font->file('foo/bar.ttf');
                $font->size(48);
                $font->color('#000000');
                $font->align('center');
                $font->valign('top');
                $font->angle(45);
            }
        );

        return $this;
    }

    /**
     * obtain image content.
     */
    public function get(): InterventionImage
    {
        return $this->picture;
    }

    public function textPosition(): array
    {
        return [
            'x' => $this->width / 2 - 100,
            'y' => $this->height / 2 - 10,
        ];
    }
}
