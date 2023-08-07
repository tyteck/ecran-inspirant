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
    protected string $text;

    public function setUp(): void
    {
        parent::setUp();
        $this->text = 'Vous ne pouvez pas être ce gamin qui reste figé en haut du toboggan en réfléchissant. Vous devez glisser. (Tina Fey)';
        $this->picture = InspirationPicture::create(828, 1792, fake()->hexColor());
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
    public function default_position(): void
    {
        InspirationFont::create($this->picture, $this->text)->applyToImage();
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_top_center(): void
    {
        InspirationFont::create($this->picture, $this->text)
            ->alignTopCenter()
            ->applyToImage()
        ;
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_top_right(): void
    {
        InspirationFont::create($this->picture, $this->text)
            ->alignTopRight()
            ->applyToImage()
        ;
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_bottom_left(): void
    {
        InspirationFont::create($this->picture, $this->text)
            ->alignBottomLeft()
            ->applyToImage()
        ;
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_bottom_center(): void
    {
        InspirationFont::create($this->picture, $this->text)
            ->alignBottomCenter()
            ->applyToImage()
        ;
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_bottom_right(): void
    {
        InspirationFont::create($this->picture, $this->text)
            ->alignBottomRight()
            ->applyToImage()
        ;
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_middle_left(): void
    {
        InspirationFont::create($this->picture, $this->text)
            ->alignMiddleLeft()
            ->applyToImage()
        ;
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_middle_center(): void
    {
        InspirationFont::create($this->picture, $this->text)
            ->alignMiddleCenter()
            ->applyToImage()
        ;
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_middle_right(): void
    {
        InspirationFont::create($this->picture, $this->text)
            ->alignMiddleRight()
            ->applyToImage()
        ;
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function add_many_text(): void
    {
        InspirationFont::create($this->picture, $this->text)
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
