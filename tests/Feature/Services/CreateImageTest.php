<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Models\Quote;
use App\Services\CreateImage;
use App\Services\InspirationPicture;
use App\Services\TailwindColors;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 */
class CreateImageTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Quote::factory()->create();
    }

    /** @test */
    public function get_should_return_inspiration_image(): void
    {
        $color = TailwindColors::init()->getOne();

        $inspirationPicture = CreateImage::create(width: 300, height: 300, bgColor: $color->dark(), fontColor: $color->light())->get();

        $this->assertNotNull($inspirationPicture);
        $this->assertInstanceOf(InspirationPicture::class, $inspirationPicture);
        $inspirationPicture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }
}
