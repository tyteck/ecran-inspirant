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
        $this->assertEquals(InspirationPicture::DEFAULT_MIME, $this->image->mime());

        $this->image->save(storage_path('tests/default.jpg'));
    }

    /** @test */
    public function modified_image_should_be_generated(): void
    {
        $expectedWitdh = 300;
        $expectedHeight = 600;
        $this->image = InspirationPicture::create(300, 600, '#DFFF00')->get();

        $this->assertInstanceOf(Image::class, $this->image);
        $this->assertEquals($expectedWitdh, $this->image->width());
        $this->assertEquals($expectedHeight, $this->image->height());

        $this->image->save(storage_path('tests/modified.jpg'));
    }

    /** @test */
    public function text_position_is_fine(): void
    {
        $position = InspirationPicture::create()
            ->textPosition()
        ;

        $this->assertIsArray($position);
        $this->assertArrayHasKey('x', $position);
        $this->assertArrayHasKey('y', $position);
        $this->assertEquals(150, $position['x']);
        $this->assertEquals(240, $position['y']);
    }

    /** @test */
    public function with_text_image_should_be_generated(): void
    {
        $this->image = InspirationPicture::create()
            ->addText('hello world')
            ->get()
        ;

        $this->assertInstanceOf(Image::class, $this->image);

        $this->image->save(storage_path('tests/text.jpg'));
    }
}
