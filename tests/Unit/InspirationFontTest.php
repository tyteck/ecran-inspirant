<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Services\InspirationFont;
use Intervention\Image\Facades\Image;
use Intervention\Image\Image as InterventionImage;
use Tests\TestCase;

/**
 * @internal
 */
class InspirationFontTest extends TestCase
{
    protected InterventionImage $image;
    protected string $forrest = "La vie, c'est comme une boîte de chocolats, on ne sait jamais sur quoi on va tomber! Forrest Gump (1994).";

    public function setUp(): void
    {
        parent::setUp();
        $this->image = Image::canvas(500, 500, fake()->hexColor())->encode('jpg', 80);
    }

    /** @test */
    public function no_text(): void
    {
        $font = InspirationFont::create($this->image, '');

        $this->assertNotNull($font);
        $this->assertInstanceOf(InspirationFont::class, $font);
        $this->assertEquals(0, $font->boxWidth());
        $this->assertEquals(0, $font->boxHeight());

        $font->get()->applyToImage($this->image, $font->positionX(), $font->positionY());
        $this->image->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function small_text(): void
    {
        $font = InspirationFont::create($this->image, 'La vie.');

        $this->assertEquals(0, $font->iterations());

        $font->get()->applyToImage($this->image, $font->positionX(), $font->positionY());
        $this->image->save(storage_path('tests/lavie.jpg'));
    }

    /** @test */
    public function align_top_left(): void
    {
        $font = InspirationFont::create($this->image, $this->forrest);

        $font->get()->applyToImage($this->image, $font->positionX(), $font->positionY());
        $this->image->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_top_center(): void
    {
        $font = InspirationFont::create($this->image, $this->forrest)->alignTopCenter();

        $font->get()->applyToImage($this->image, $font->positionX(), $font->positionY());
        $this->image->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_top_right(): void
    {
        $font = InspirationFont::create($this->image, $this->forrest)->alignTopRight();

        $font->get()->applyToImage($this->image, $font->positionX(), $font->positionY());
        $this->image->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_bottom_left(): void
    {
        $font = InspirationFont::create($this->image, $this->forrest)->alignBottomLeft();

        $font->get()->applyToImage($this->image, $font->positionX(), $font->positionY());
        $this->image->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_bottom_center(): void
    {
        $font = InspirationFont::create($this->image, $this->forrest)->alignBottomCenter();

        $font->get()->applyToImage($this->image, $font->positionX(), $font->positionY());
        $this->image->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_bottom_right(): void
    {
        $font = InspirationFont::create($this->image, $this->forrest)->alignBottomRight();

        $font->get()->applyToImage($this->image, $font->positionX(), $font->positionY());
        $this->image->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_middle_left(): void
    {
        $font = InspirationFont::create($this->image, $this->forrest)->alignMiddleLeft();

        $font->get()->applyToImage($this->image, $font->positionX(), $font->positionY());
        $this->image->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_middle_center(): void
    {
        $font = InspirationFont::create($this->image, $this->forrest)->alignMiddleCenter();

        $font->get()->applyToImage($this->image, $font->positionX(), $font->positionY());
        $this->image->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function align_middle_right(): void
    {
        $font = InspirationFont::create($this->image, $this->forrest)->alignMiddleRight();

        $font->get()->applyToImage($this->image, $font->positionX(), $font->positionY());
        $this->image->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }

    /** @test */
    public function with_some_text_on_creation_should_be_good(): void
    {
        $font = InspirationFont::create($this->image, $this->forrest)->alignMiddleCenter();

        $this->assertNotNull($font);
        $this->assertInstanceOf(InspirationFont::class, $font);
        $this->assertGreaterThan(0, $font->boxWidth());
        $this->assertGreaterThan(0, $font->boxHeight());

        $font->get()->applyToImage($this->image, $font->positionX(), $font->positionY());
        $this->image->save(storage_path('tests/chocolat.jpg'));
    }

    public function with_text_function_should_be_good(): void
    {
        $font = InspirationFont::create($this->image, '')
            ->text($this->forrest)
        ;

        $this->assertNotNull($font);
        $this->assertInstanceOf(InspirationFont::class, $font);
        $this->assertGreaterThan(0, $font->boxWidth());
        $this->assertGreaterThan(0, $font->boxHeight());

        $font->get()->applyToImage($this->image, $font->positionX(), $font->positionY());
        $this->image->save(storage_path('tests/chocolat2.jpg'));
    }
}
