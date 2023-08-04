<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\App;
use Intervention\Image\Facades\Image;
use Intervention\Image\Image as InterventionImage;
use Intervention\Image\Imagick\Font as InterventionFont;
use InvertColor\Color;

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
        protected ?string $textColor = null,
        protected int $textSize = self::DEFAULT_TEXT_SIZE,
        protected string $textFont = self::DEFAULT_FONT,
    ) {
        $this->originalTextSize = $this->textSize;
        $this->checkColors();

        $this->picture = Image::canvas($this->width, $this->height, $this->backgroundColor)
            ->encode('jpg', 80)
        ;

        $this->font = (new InterventionFont(''))
            ->file(public_path("fonts/{$this->textFont}"))
            ->color($this->textColor)
            ->align('center')
            ->valign('middle')
            ->size($this->textSize)
        ;
    }

    public static function create(...$params)
    {
        return new static(...$params);
    }

    public function addText(string $text): self
    {
        $chunks = chunkText($text);
        if (count($chunks) > 1) {
            $this->multiline = true;
        }
        $text = implode(PHP_EOL, $chunks);

        $this->prepareFontWithText($text);

        $this->font->applyToImage($this->picture, $this->textPosition()['x'], $this->textPosition()['y']);

        if (!App::environment('production')) {
            $this->addDebugInfo();
        }

        return $this;
    }

    /**
     * obtain image content.
     */
    public function get(): InterventionImage
    {
        $this->addWatermark();

        return $this->picture;
    }

    public function textPosition(): array
    {
        $boxSize = $this->font->getBoxSize();

        return [
            'x' => $this->width / 2,
            'y' => $this->height / 2 - $boxSize['height'] / 2 - $this->textSize / 2,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | protected
    |--------------------------------------------------------------------------
    */
    protected function checkColors(): void
    {
        if (!$this->textColor && $this->backgroundColor) {
            $this->textColor = Color::fromHex($this->backgroundColor)->invert(); // #000000

            return;
        }

        if (!$this->backgroundColor && $this->textColor) {
            $this->backgroundColor = Color::fromHex($this->textColor)->invert(); // #000000

            return;
        }
        $this->backgroundColor = self::DEFAULT_BACKGROUND_COLOR;
        $this->textColor = self::DEFAULT_TEXT_COLOR;
    }

    protected function prepareFontWithText(string $text): void
    {
        $this->font->text($text);
        $this->adjustFontSize();
    }

    protected function adjustFontSize(): void
    {
        $box = $this->font->getBoxSize();
        if ($box['width'] < $this->width) {
            return;
        }

        $this->textSize -= 4;
        $this->font->size($this->textSize);
        $this->adjustFontSize($this->font);
    }

    protected function addWatermark(): void
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
                $this->adjustFontSize();
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
    }
}
