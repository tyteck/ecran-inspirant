<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Services\FontPathSelector;
use App\Services\InspirationFont;
use App\Services\InspirationPicture;
use Tests\TestCase;

/**
 * @internal
 */
class InspirationFontTest extends TestCase
{
    protected string $fontPath;
    protected InspirationPicture $picture;
    protected string $text;

    public function setUp(): void
    {
        parent::setUp();
        $this->text = 'Vous ne pouvez pas être ce gamin qui reste figé en haut du toboggan en réfléchissant. Vous devez glisser. (Tina Fey)';
        $this->picture = InspirationPicture::create(828, 1792, fake()->hexColor());
        $this->fontPath = (new FontPathSelector())->getOneFont();
    }

    /** @test */
    public function no_text(): void
    {
        $font = InspirationFont::create(picture: $this->picture, fontPath: $this->fontPath, text: '');

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
        $font = InspirationFont::create(picture: $this->picture, fontPath: $this->fontPath, text: 'La vie.');

        $this->assertEquals(0, $font->iterations());

        $font->applyToImage();
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function default_position(): void
    {
        InspirationFont::create(picture: $this->picture, fontPath: $this->fontPath, text: $this->text)->applyToImage();
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_top_center(): void
    {
        InspirationFont::create(picture: $this->picture, fontPath: $this->fontPath, text: $this->text)
            ->alignTopCenter()
            ->applyToImage()
        ;
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_top_right(): void
    {
        InspirationFont::create(picture: $this->picture, fontPath: $this->fontPath, text: $this->text)
            ->alignTopRight()
            ->applyToImage()
        ;
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_bottom_left(): void
    {
        InspirationFont::create(picture: $this->picture, fontPath: $this->fontPath, text: $this->text)
            ->alignBottomLeft()
            ->applyToImage()
        ;
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_bottom_center(): void
    {
        InspirationFont::create(picture: $this->picture, fontPath: $this->fontPath, text: $this->text)
            ->alignBottomCenter()
            ->applyToImage()
        ;
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_bottom_right(): void
    {
        InspirationFont::create(picture: $this->picture, fontPath: $this->fontPath, text: $this->text)
            ->alignBottomRight()
            ->applyToImage()
        ;
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_middle_left(): void
    {
        InspirationFont::create(picture: $this->picture, fontPath: $this->fontPath, text: $this->text)
            ->alignMiddleLeft()
            ->applyToImage()
        ;
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_middle_center(): void
    {
        InspirationFont::create(picture: $this->picture, fontPath: $this->fontPath, text: $this->text)
            ->alignMiddleCenter()
            ->applyToImage()
        ;
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_middle_right(): void
    {
        InspirationFont::create(picture: $this->picture, fontPath: $this->fontPath, text: $this->text)
            ->alignMiddleRight()
            ->applyToImage()
        ;
        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function add_many_text(): void
    {
        InspirationFont::create(picture: $this->picture, fontPath: $this->fontPath, text: $this->text)
            ->alignMiddleCenter()
            ->applyToImage()
        ;

        InspirationFont::create(picture: $this->picture, fontPath: $this->fontPath, text: 'Watermark', textSize: 12)
            ->alignBottomRight()
            ->applyToImage()
        ;

        InspirationFont::create(picture: $this->picture, fontPath: $this->fontPath, text: 'debug', textSize: 12)
            ->alignTopLeft()
            ->applyToImage()
        ;

        $this->picture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
        $this->assertFileExists(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }
}
