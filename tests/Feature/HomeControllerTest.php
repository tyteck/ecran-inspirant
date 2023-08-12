<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 */
class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Quote::factory()->create(['text' => 'Je pense, donc je suis.', 'source' => 'René Descartes']);
    }

    /** @test */
    public function home_should_be_accessible(): void
    {
        $this->get(route('index'))
            ->assertSuccessful()
            ->assertSee([
                'meta property="og:title"',
                'meta property="og:type"',
                'meta property="og:url"',
                'meta property="og:image"',
                'meta property="og:description"',
                'meta name="csrf-token"',
            ], escape: false)
        ;
    }

    /** @test */
    public function www_home_should_be_accessible(): void
    {
        $this->get(route('www.index'))
            ->assertSuccessful()
        ;
    }
}
