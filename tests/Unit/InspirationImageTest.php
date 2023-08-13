<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Services\InspirationPicture;
use Intervention\Image\Image;
use Tests\TestCase;
use Tests\Traits\ImageExpectations;

/**
 * @internal
 */
class InspirationImageTest extends TestCase
{
    use ImageExpectations;

    protected Image $image;

    /** @test */
    public function default_image_should_be_generated(): void
    {
        $expectedWidth = InspirationPicture::DEFAULT_WIDTH;
        $expectedHeight = InspirationPicture::DEFAULT_HEIGHT;
        $this->image = InspirationPicture::create()->get();

        $this->assertInstanceOf(Image::class, $this->image);
        $this->assertEquals(InspirationPicture::DEFAULT_WIDTH, $this->image->width());
        $this->assertEquals(InspirationPicture::DEFAULT_HEIGHT, $this->image->height());

        $this->checkImageExpectations($this->image->getEncoded(), $expectedWidth, $expectedHeight);
        $this->image->save(storage_path('tests/default.jpg'));
    }

    /** @test */
    public function modified_image_should_be_generated(): void
    {
        $expectedWidth = 300;
        $expectedHeight = 600;
        $this->image = InspirationPicture::create($expectedWidth, $expectedHeight, '#DFFF00')
            ->get()
        ;

        $this->assertInstanceOf(Image::class, $this->image);
        $this->assertEquals($expectedWidth, $this->image->width());
        $this->assertEquals($expectedHeight, $this->image->height());

        $this->checkImageExpectations($this->image->getEncoded(), $expectedWidth, $expectedHeight);
        $this->image->save(storage_path('tests/modified.jpg'));
    }
}
