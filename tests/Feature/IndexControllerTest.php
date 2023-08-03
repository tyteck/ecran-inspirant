<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

/**
 * @internal
 */
class IndexControllerTest extends TestCase
{
    /** @test */
    public function home_should_be_accessible(): void
    {
        $this->get(route('index'))
            ->assertSuccessful()
            ->assertSeeText('Documentation')
        ;
    }
}
