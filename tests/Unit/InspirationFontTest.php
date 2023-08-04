<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Services\InspirationFont;
use Tests\TestCase;

/**
 * @internal
 */
class InspirationFontTest extends TestCase
{
    protected string $lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi bibendum non sapien vitae tempus. Nulla pellentesque ornare sagittis.';

    /** @test */
    public function even_with_no_text_should_be_good(): void
    {
        $font = InspirationFont::create(maxWidth: 300);

        $this->assertNotNull($font);
        $this->assertInstanceOf(InspirationFont::class, $font);
        $this->assertEquals(0, $font->boxWidth());
        $this->assertEquals(0, $font->boxHeight());
    }

    /** @test */
    public function with_some_text_should_be_good(): void
    {
        $font = InspirationFont::create(
            text: "La vie, c'est comme une boîte de chocolats, on ne sait jamais sur quoi on va tomber! Forrest Gump (1994).",
            maxWidth: 300
        );

        dump($font);
        $this->assertNotNull($font);
        $this->assertInstanceOf(InspirationFont::class, $font);
        $this->assertGreaterThan(0, $font->boxWidth());
        $this->assertGreaterThan(0, $font->boxHeight());
    }
}
