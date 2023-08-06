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

    /** @test */
    public function get_should_be_accessible(): void
    {
        Quote::factory()->create(['text' => 'Je pense, donc je suis.', 'source' => 'René Descartes']);

        $this->get(route('get'))
            ->assertSuccessful()
            ->assertHeader('Content-Type', 'image/jpeg')
        ;
    }
}
