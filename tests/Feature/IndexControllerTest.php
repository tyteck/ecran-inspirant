<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 */
class IndexControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function home_should_be_accessible(): void
    {
        Quote::factory()->create(['text' => 'Je pense, donc je suis.', 'source' => 'René Descartes']);

        $this->get(route('index'))
            ->assertSuccessful()
            ->assertSeeText('Documentation')
        ;
    }
}
