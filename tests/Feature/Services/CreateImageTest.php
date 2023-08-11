<?php

declare(strict_types=1);

namespace Tests\Feature\Service;

use App\Enums\Colors;
use App\Models\Quote;
use App\Services\CreateImage;
use App\Services\InspirationPicture;
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
        $inspirationPicture = CreateImage::create(300, 300, Colors::random())->get();

        $this->assertNotNull($inspirationPicture);
        $this->assertInstanceOf(InspirationPicture::class, $inspirationPicture);
        $inspirationPicture->save(storage_path('tests/' . __FUNCTION__ . '.jpg'));
    }
}
