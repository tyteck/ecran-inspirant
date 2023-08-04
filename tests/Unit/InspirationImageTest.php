<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Services\InspirationPicture;
use Intervention\Image\Image;
use Tests\TestCase;

/**
 * @internal
 */
class InspirationImageTest extends TestCase
{
    protected Image $image;

    /** @test */
    public function default_image_should_be_generated(): void
    {
        $this->image = InspirationPicture::create()->get();

        $this->assertInstanceOf(Image::class, $this->image);
        $this->assertEquals(InspirationPicture::DEFAULT_WIDTH, $this->image->width());
        $this->assertEquals(InspirationPicture::DEFAULT_HEIGHT, $this->image->height());
        // $this->assertEquals(InspirationPicture::DEFAULT_MIME, $this->image->mime());

        $this->image->save(storage_path('tests/default.jpg'));
    }

    /** @test */
    public function modified_image_should_be_generated(): void
    {
        $expectedWitdh = 300;
        $expectedHeight = 600;
        $this->image = InspirationPicture::create($expectedWitdh, $expectedHeight, '#DFFF00')
            ->addText(fake()->sentence())
            ->get()
        ;

        $this->assertInstanceOf(Image::class, $this->image);
        $this->assertEquals($expectedWitdh, $this->image->width());
        $this->assertEquals($expectedHeight, $this->image->height());

        $this->image->save(storage_path('tests/modified.jpg'));
    }

    /** @test */
    public function with_short_text_image_should_be_generated(): void
    {
        $this->image = InspirationPicture::create(828, 1200)
            ->addText("La vie c'est comme une boite de chocolat.")
            ->get()
        ;

        $this->assertInstanceOf(Image::class, $this->image);

        $this->image->save(storage_path('tests/shorttext.jpg'));
    }

    /** @test */
    public function with_long_text_image_should_be_generated(): void
    {
        $this->image = InspirationPicture::create(width: 828, height: 1200, backgroundColor: fake()->hexColor())
            ->addText(fake()->sentences(nb: 3, asText: true))
            ->get()
        ;

        $this->assertInstanceOf(Image::class, $this->image);

        $this->image->save(storage_path('tests/longtext.jpg'));
    }

    /** @test */
    public function for_desktop_long_text_image_should_be_generated(): void
    {
        $this->image = InspirationPicture::create(width: 4096, height: 2060, backgroundColor: fake()->hexColor())
            ->addText(fake()->sentences(nb: 3, asText: true))
            ->get()
        ;

        $this->assertInstanceOf(Image::class, $this->image);

        $this->image->save(storage_path('tests/desktop.jpg'));
    }
}
