<?php

declare(strict_types=1);

namespace App\Services;

use Intervention\Image\Facades\Image;
use Intervention\Image\Image as InterventionImage;
use Intervention\Image\Imagick\Font as InterventionFont;

class InspirationPicture
{
    public const DEFAULT_WIDTH = 500;
    public const DEFAULT_HEIGHT = 500;
    public const DEFAULT_BACKGROUND_COLOR = '#5858FA';
    public const DEFAULT_TEXT_COLOR = '#FFFFFF';
    public const DEFAULT_TEXT_SIZE = 64;
    public const DEFAULT_MIME = 'image/jpeg';
    public const DEFAULT_FONT = 'Roboto/Roboto-Regular.ttf';

    protected InterventionImage $picture;
    protected InterventionFont $font;

    protected bool $multiline = false;
    protected int $originalTextSize;

    private function __construct(
        protected int $width = self::DEFAULT_WIDTH,
        protected int $height = self::DEFAULT_HEIGHT,
        protected ?string $backgroundColor = null,
    ) {
        $this->picture = Image::canvas($this->width, $this->height, $this->backgroundColor)
            ->encode('jpg', 80)
        ;
    }

    public static function create(...$params)
    {
        return new static(...$params);
    }

    /**
     * obtain image content.
     */
    public function get(): InterventionImage
    {
        return $this->picture;
    }

    public function backgroundColor(): string
    {
        return $this->backgroundColor;
    }

    public function width(): int
    {
        return $this->width;
    }

    public function height(): int
    {
        return $this->height;
    }

    public function save(string $path): void
    {
        $this->picture->save($path);
    }

    /*
    |--------------------------------------------------------------------------
    | protected
    |--------------------------------------------------------------------------
    */

    /* protected function addWatermark(): void
    {
        $this->picture->text(
            'inspired.com',
            $this->width - 20,
            $this->height - 20,
            function ($font): void {
                $font->file(public_path('fonts/Roboto/Roboto-Regular.ttf'));
                $font->size(16);
                $font->color('000000');
                $font->align('right');
                $font->valign('bottom');
            }
        );
    }

    protected function addDebugInfo(): void
    {
        $debugText = 'middle : ' . $this->picture->width() / 2 . ',' . $this->picture->height() / 2 . PHP_EOL .
            'text position : ' . $this->textPosition()['x'] . ',' . $this->textPosition()['y'] . PHP_EOL .
            'text font size(asked): ' . $this->textSize . "({$this->originalTextSize})" . PHP_EOL .
            'text box size : ' . $this->font->getBoxSize()['width'] . 'x' . $this->font->getBoxSize()['height'] . PHP_EOL .
            'bg color : ' . $this->backgroundColor . ' - text :' . $this->textColor . PHP_EOL .
            'multiline : ' . ($this->multiline ? 'true' : 'false') . PHP_EOL .
            'dimensions : ' . $this->width . 'x' . $this->height;
        $this->picture->text(
            $debugText,
            0,
            0,
            function ($font): void {
                $font->file(public_path('fonts/Roboto/Roboto-Regular.ttf'));
                $font->size(12);
                $font->color('000000');
                $font->align('left');
                $font->valign('top');
            }
        );

        // draw line in the middle
        $this->picture->line(0, $this->picture->height() / 2, $this->picture->height(), $this->picture->height() / 2, function ($draw): void {
            $draw->color('#000000');
        });
        $this->picture->line($this->picture->width() / 2, 0, $this->picture->width() / 2, $this->picture->height(), function ($draw): void {
            $draw->color('#000000');
        });
    } */
}
