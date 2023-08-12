<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 */
class QuoteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Quote::factory()->create(['text' => 'Je pense, donc je suis.', 'source' => 'René Descartes']);
    }

    /** @test */
    public function get_from_route_should_be_accessible(): void
    {
        $this->get(route('createPicture'))
            ->assertSuccessful()
            ->assertHeader('Content-Type', 'image/jpeg')
        ;
    }

    /** @test */
    public function get_from_url_should_be_accessible(): void
    {
        $this->get('http://get.' . config('app.domain'))
            ->assertSuccessful()
            ->assertHeader('Content-Type', 'image/jpeg')
        ;
    }

    /** @test */
    public function get_should_accept_presets(): void
    {
        $route = route('createPicture', ['presetOrWidth' => 'iphone8']);
        $this->get($route)
            ->assertSuccessful()
            ->assertHeader('Content-Type', 'image/jpeg')
        ;
    }
}
