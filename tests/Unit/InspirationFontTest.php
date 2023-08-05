<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Services\InspirationFont;
use App\Services\InspirationPicture;
use Tests\TestCase;

/**
 * @internal
 */
class InspirationFontTest extends TestCase
{
    protected InspirationPicture $picture;
    protected string $forrest = "La vie, c'est comme une boîte de chocolats, on ne sait jamais sur quoi on va tomber! Forrest Gump (1994).";

    public function setUp(): void
    {
        parent::setUp();
        $this->picture = InspirationPicture::create(500, 500, fake()->hexColor());
    }

    /** @test */
    public function no_text(): void
    {
        $font = InspirationFont::create($this->picture, '');

        $this->assertNotNull($font);
        $this->assertInstanceOf(InspirationFont::class, $font);
        $this->assertEquals(0, $font->boxWidth());
        $this->assertEquals(0, $font->boxHeight());

        $font->applyToImage();
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function small_text(): void
    {
        $font = InspirationFont::create($this->picture, 'La vie.');

        $this->assertEquals(0, $font->iterations());

        $font->applyToImage();
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_top_left(): void
    {
        InspirationFont::create($this->picture, $this->forrest)->applyToImage();
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_top_center(): void
    {
        InspirationFont::create($this->picture, $this->forrest)
            ->alignTopCenter()
            ->applyToImage()
        ;
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_top_right(): void
    {
        InspirationFont::create($this->picture, $this->forrest)
            ->alignTopRight()
            ->applyToImage()
        ;
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_bottom_left(): void
    {
        InspirationFont::create($this->picture, $this->forrest)
            ->alignBottomLeft()
            ->applyToImage()
        ;
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_bottom_center(): void
    {
        InspirationFont::create($this->picture, $this->forrest)
            ->alignBottomCenter()
            ->applyToImage()
        ;
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_bottom_right(): void
    {
        InspirationFont::create($this->picture, $this->forrest)
            ->alignBottomRight()
            ->applyToImage()
        ;
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_middle_left(): void
    {
        InspirationFont::create($this->picture, $this->forrest)
            ->alignMiddleLeft()
            ->applyToImage()
        ;
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_middle_center(): void
    {
        InspirationFont::create($this->picture, $this->forrest)
            ->alignMiddleCenter()
            ->applyToImage()
        ;
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_middle_right(): void
    {
        InspirationFont::create($this->picture, $this->forrest)
            ->alignMiddleRight()
            ->applyToImage()
        ;
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function long_text_centered(): void
    {
        $font = InspirationFont::create($this->picture, $this->forrest)->alignMiddleCenter();

        $this->assertNotNull($font);
        $this->assertInstanceOf(InspirationFont::class, $font);
        $this->assertGreaterThan(0, $font->boxWidth());
        $this->assertGreaterThan(0, $font->boxHeight());

        $font->applyToImage();
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function add_many_text(): void
    {
        InspirationFont::create($this->picture, $this->forrest)
            ->alignMiddleCenter()
            ->applyToImage()
        ;

        InspirationFont::create($this->picture, 'Watermark', 12)
            ->alignBottomRight()
            ->applyToImage()
        ;

        InspirationFont::create($this->picture, 'debug', 12)
            ->alignTopLeft()
            ->applyToImage()
        ;

        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }
}
