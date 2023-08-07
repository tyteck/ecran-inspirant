<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\FontFileDoNotExistsException;
use Intervention\Image\Imagick\Font as imagickFont;

class InspirationFont
{
    public const DEFAULT_FONT = 'Roboto/Roboto-Regular.ttf';
    public const DEFAULT_TEXT_SIZE = 128;
    public const MINIMUM_TEXT_SIZE = 8;

    protected imagickFont $imagickFont;
    protected array $boxSize;
    protected int $iterations = 0;
    protected int $positionX;
    protected int $positionY;

    private function __construct(
        protected InspirationPicture $picture,
        protected string $text = '',
        protected int $textSize = self::DEFAULT_TEXT_SIZE,
        protected ?string $textColor = null,
        protected string $textFont = self::DEFAULT_FONT,
    ) {
        $this->checkFontExists();

        $this->imagickFont = (new imagickFont($this->text))
            ->file(public_path("fonts/{$this->textFont}"))
            ->color($this->textColor)
            ->size($this->textSize)
        ;

        $this->prepareText();

        $this->alignMiddleCenter();

        $this->setTextColor();

        $this->boxSize = $this->imagickFont->getBoxSize();
    }

    public static function create(...$params)
    {
        return new static(...$params);
    }

    public function availableWidth(): int
    {
        return intval(round($this->picture->width() * 0.95));
    }

    public function text(string $text): self
    {
        $this->text = $text;

        $this->prepareText();

        return $this;
    }

    protected function setTextColor(): self
    {
        $this->imagickFont->color(
            getContrastColor($this->picture->backgroundColor())
        );

        return $this;
    }

    public function boxWidth(): int
    {
        return $this->boxSize['width'];
    }

    public function boxHeight(): int
    {
        return $this->boxSize['height'];
    }

    /**
     * obtain image content.
     */
    public function get(): imagickFont
    {
        return $this->imagickFont;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function iterations(): int
    {
        return $this->iterations;
    }

    public function alignTopLeft(): self
    {
        $this->positionX = 0;
        $this->positionY = 0;
        $this->imagickFont->valign('top')
            ->align('left')
        ;

        return $this;
    }

    public function alignTopCenter(): self
    {
        $this->positionX = (int) round($this->picture->width() / 2);
        $this->positionY = 0;
        $this->imagickFont->valign('top')
            ->align('center')
        ;

        return $this;
    }

    public function alignTopRight(): self
    {
        $this->positionX = $this->picture->width();
        $this->positionY = 0;
        $this->imagickFont->valign('top')
            ->align('right')
        ;

        return $this;
    }

    public function alignBottomLeft(): self
    {
        $this->positionX = 0;
        $this->positionY = (int) round($this->picture->height() - $this->imagickFont->getBoxSize()['height']);
        $this->imagickFont->valign('bottom')
            ->align('left')
        ;

        return $this;
    }

    public function alignBottomCenter(): self
    {
        $this->positionX = $this->imageCenter();
        $this->positionY = $this->picture->height() - $this->imagickFont->getBoxSize()['height'];
        $this->imagickFont->valign('bottom')
            ->align('center')
        ;

        return $this;
    }

    public function alignBottomRight(): self
    {
        $this->positionX = $this->picture->width();
        $this->positionY = (int) round($this->picture->height() - $this->imagickFont->getBoxSize()['height']);
        $this->imagickFont->valign('bottom')
            ->align('right')
        ;

        return $this;
    }

    public function alignMiddleLeft(): self
    {
        $this->positionX = 0;
        $this->positionY = $this->imageMiddle() - $this->boxHeightMiddle();
        $this->imagickFont->valign('top')
            ->align('left')
        ;

        return $this;
    }

    public function alignMiddleCenter(): self
    {
        $this->positionX = $this->imageCenter();
        $this->positionY = $this->imageMiddle() - $this->boxHeightMiddle();
        $this->imagickFont->valign('top')
            ->align('center')
        ;

        return $this;
    }

    public function alignMiddleRight(): self
    {
        $this->positionX = $this->picture->width();
        $this->positionY = $this->imageMiddle() - $this->boxHeightMiddle();
        $this->imagickFont->valign('top')
            ->align('right')
        ;

        return $this;
    }

    /* public function addDebugInfo(): self
    {
        $debugText = 'picture dimensions : ' . $this->picture->width() . 'x' . $this->picture->height() . PHP_EOL .
            'picture middle : ' . $this->imageCenter() . ':' . $this->imageMiddle() . PHP_EOL .
            'text position : ' . $this->positionX . ':' . $this->positionY . PHP_EOL .
            'text font size : ' . $this->textSize . PHP_EOL .
            'text box size : ' . $this->imagickFont->getBoxSize()['width'] . 'x' . $this->imagickFont->getBoxSize()['height'] . PHP_EOL;
        (new imagickFont($debugText))
            ->file($this->fontPath())
            ->color('#000000')
            ->size(48)
            ->valign('top')
            ->align('left')
            ->applyToImage($this->picture->get(), 0, 0)
        ;

        return $this;
    } */

    public function applyToImage(): void
    {
        $this->imagickFont->applyToImage($this->picture->get(), $this->positionX, $this->positionY);
    }

    public function checkFontExists(): void
    {
        throw_unless(
            file_exists($this->fontPath()),
            new FontFileDoNotExistsException('Font file {' . $this->fontPath() . '} do not exists.')
        );
    }

    public function fontPath(): string
    {
        return public_path('fonts/' . $this->textFont);
    }

    /*
    |--------------------------------------------------------------------------
    | protected
    |--------------------------------------------------------------------------
    */
    protected function imageCenter(): int
    {
        return intval(round($this->picture->width() / 2));
    }

    protected function imageMiddle(): int
    {
        return intval(round($this->picture->height() / 2));
    }

    protected function boxHeightMiddle(): int
    {
        return intval(round($this->imagickFont->getBoxSize()['height'] / 2));
    }

    protected function prepareText(): void
    {
        if ($this->doesTextFit()) {
            return;
        }

        // starting with a chunk smart on punctuation characters
        $this->text = chunkSmart($this->text, asString: true);
        $this->imagickFont->text($this->text);
        if ($this->doesTextFit()) {
            return;
        }

        // not fitting, let's chunk by 4 words
        $chunks = chunkText(
            text: $this->text,
            separator: " \n",
            assemble: 4
        );
        $this->text = implode(PHP_EOL, $chunks);
        $this->imagickFont->text($this->text);
        if ($this->doesTextFit()) {
            return;
        }

        // finally we need to reduce police font size
        $this->textSize -= 8;
        $this->imagickFont->size($this->textSize);

        // and rerun
        $this->prepareText();
    }

    protected function doesTextFit(): bool
    {
        $this->boxSize = $this->imagickFont->getBoxSize();
        if (
            $this->boxSize['width'] < $this->picture->width()
            && $this->boxSize['height'] < $this->picture->height()
        ) {
            return true;
        }
        $this->iterations++;

        return false;
    }
}
