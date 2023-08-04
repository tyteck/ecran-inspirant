<?php

declare(strict_types=1);

namespace App\Services;

use Intervention\Image\Facades\Image;
use Intervention\Image\Imagick\Font as InterventionFont;

class InspirationFont
{
    public const DEFAULT_FONT = 'Roboto/Roboto-Regular.ttf';
    public const DEFAULT_TEXT_SIZE = 64;

    protected InterventionFont $font;
    protected array $boxSize;

    private function __construct(
        protected int $maxWidth,
        protected string $text = '',
        protected int $textSize = self::DEFAULT_TEXT_SIZE,
        protected ?string $textColor = null,
        protected string $textFont = self::DEFAULT_FONT,
    ) {
        $this->prepareText();

        $this->font = (new InterventionFont($this->text))
            ->file(public_path("fonts/{$this->textFont}"))
            ->color($this->textColor)
            ->align('center')
            ->valign('middle')
            ->size($this->textSize)
        ;
        $this->boxSize = $this->font->getBoxSize();
    }

    public static function create(...$params)
    {
        return new static(...$params);
    }

    public function text(string $text): self
    {
        $this->prepareFontWithText($text);

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

    /*
    |--------------------------------------------------------------------------
    | protected
    |--------------------------------------------------------------------------
    */
    protected function prepareText(): void
    {
        $chunks = chunkText($this->text, ".\n");

        $this->text = implode(PHP_EOL, $chunks);

        $this->font->text($this->text);

        $box = $this->font->getBoxSize();
        if ($box['width'] < $this->maxWidth) {
            return;
        }
    }

    protected function prepareFontWithText(string $text): void
    {
        $chunks = chunkText($text);

        $text = implode(PHP_EOL, $chunks);

        $this->font->text($text);
        $this->adjustFontSize();
    }

    protected function adjustFontSize(): void
    {
        $box = $this->font->getBoxSize();
        if ($box['width'] < $this->maxWidth) {
            return;
        }

        $this->textSize -= 4;
        $this->font->size($this->textSize);
        $this->adjustFontSize($this->font);
    }
}
