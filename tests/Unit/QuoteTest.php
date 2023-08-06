<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 */
class QuoteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function get_should_render_text_with_source(): void
    {
        Quote::factory()->create(['text' => 'Je pense, donc je suis.', 'source' => 'René Descartes']);

        $result = Quote::getOne();

        $this->assertNotNull($result);
        $this->assertEquals('Je pense, donc je suis. (René Descartes)', $result);
    }
}
