<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\TextIsTooBigForImageWidthException;
use Intervention\Image\Image as InterventionImage;
use Intervention\Image\Imagick\Font as InterventionFont;

class InspirationFont
{
    public const DEFAULT_FONT = 'Roboto/Roboto-Regular.ttf';
    public const DEFAULT_TEXT_SIZE = 128;
    public const MINIMUM_TEXT_SIZE = 8;

    protected InterventionFont $font;
    protected array $boxSize;
    protected string $originalText;
    protected int $iterations = 0;
    protected int $positionX;
    protected int $positionY;

    private function __construct(
        protected InterventionImage $image,
        protected string $text = '',
        protected int $textSize = self::DEFAULT_TEXT_SIZE,
        protected ?string $textColor = null,
        protected string $textFont = self::DEFAULT_FONT,
    ) {
        $this->originalText = $this->text;
        $this->font = (new InterventionFont($this->text))
            ->file(public_path("fonts/{$this->textFont}"))
            ->color($this->textColor)
            ->size($this->textSize)
        ;
        $this->alignTopLeft();
        $this->prepareText();

        $this->boxSize = $this->font->getBoxSize();
    }

    public static function create(...$params)
    {
        return new static(...$params);
    }

    public function text(string $text): self
    {
        $this->text = $text;
        $this->originalText = $text;

        $this->prepareText();

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
    public function get(): InterventionFont
    {
        return $this->font;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function iterations(): int
    {
        return $this->iterations;
    }

    public function positionX(): int
    {
        return $this->positionX;
    }

    public function positionY(): int
    {
        return $this->positionY;
    }

    public function alignTopLeft(): self
    {
        $this->positionX = 0;
        $this->positionY = 0;
        $this->font->align('left')
            ->valign('top')
        ;

        return $this;
    }

    public function alignTopCenter(): self
    {
        $this->positionX = $this->image->width() / 2;
        $this->positionY = 0;
        $this->font->align('center')
            ->valign('top')
        ;

        return $this;
    }

    public function alignTopRight(): self
    {
        $this->positionX = $this->image->width();
        $this->positionY = 0;
        $this->font->align('right')
            ->valign('top')
        ;

        return $this;
    }

    public function alignBottomLeft(): self
    {
        $this->positionX = 0;
        $this->positionY = $this->image->height() - $this->font->getBoxSize()['height'] - 10;
        $this->font->align('left')
            ->valign('bottom')
        ;

        return $this;
    }

    public function alignBottomCenter(): self
    {
        $this->positionX = $this->image->width() / 2;
        $this->positionY = $this->image->height() - 10;
        $this->font->align('center')
            ->valign('bottom')
        ;

        return $this;
    }

    public function alignBottomRight(): self
    {
        $this->positionX = $this->image->width();
        $this->positionY = $this->image->height() - 10;
        $this->font->align('right')
            ->valign('bottom')
        ;

        return $this;
    }

    public function alignMiddleLeft(): self
    {
        $this->positionX = 0;
        $this->positionY = $this->image->height() / 2 - $this->font->getBoxSize()['height'] / 2 - $this->textSize / 2;
        $this->font->align('left')
            ->valign('middle')
        ;

        return $this;
    }

    public function alignMiddleCenter(): self
    {
        $this->positionX = $this->image->width() / 2;
        $this->positionY = $this->image->height() / 2 - $this->font->getBoxSize()['height'] / 2 - $this->textSize / 2;
        $this->font->align('center')
            ->valign('middle')
        ;

        return $this;
    }

    public function alignMiddleRight(): self
    {
        $this->positionX = $this->image->width();
        $this->positionY = $this->image->height() / 2 - $this->font->getBoxSize()['height'] / 2 - $this->textSize / 2;
        $this->font->align('right')
            ->valign('middle')
        ;

        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | protected
    |--------------------------------------------------------------------------
    */
    protected function prepareText(): void
    {
        if ($this->doesTextFit()) {
            return;
        }

        // starting with a chunk smart on punctuation characters
        $this->text = chunkSmart($this->text, asString: true);
        $this->font->text($this->text);
        if ($this->doesTextFit()) {
            return;
        }

        // not fitting, let's chunk by words
        // 4 then 3 words block
        foreach ([4, 3] as $assemble) {
            $chunks = chunkText(
                text: $this->text,
                separator: " \n",
                assemble: $assemble
            );
            $this->text = implode(PHP_EOL, $chunks);
            $this->font->text($this->text);
            if ($this->doesTextFit()) {
                return;
            }
        }

        // finally we need to reduce police font size
        $this->reduceFontSize();

        dump(
            'iterations : ' . $this->iterations,
            'final text : ' . $this->text,
            'text size : ' . $this->textSize,
        );
    }

    protected function reduceFontSize(): void
    {
        $this->text = chunkSmart($this->originalText, asString: true);
        $this->font->text($this->text);
        while (1) {
            $this->textSize -= 8;
            throw_if(
                $this->textSize < self::MINIMUM_TEXT_SIZE,
                new TextIsTooBigForImageWidthException(
                    'Text is too long for image width and font size cannot be reduced below ' . self::MINIMUM_TEXT_SIZE . '.'
                )
            );
            $this->font->size($this->textSize);
            if ($this->doesTextFit()) {
                break;
            }
        }
    }

    protected function doesTextFit(): bool
    {
        $this->boxSize = $this->font->getBoxSize();
        if ($this->boxSize['width'] < $this->image->width()) {
            // it fits after chunk smart ! let's go.
            return true;
        }
        $this->iterations++;

        return false;
    }
}
