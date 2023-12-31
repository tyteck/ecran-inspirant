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
                'meta property="og:locale"',
                'meta property="og:image:type"',
                'meta property="og:image:width"',
                'meta property="og:image:height"',
                'meta name="csrf-token"',
                '<strong>Le principe :</strong>',
                '<strong>Comment faire ?</strong>',
                '<img class="rounded-lg mx-auto" src="/images/welcome.jpg">',
            ], escape: false)
        ;
    }
}
