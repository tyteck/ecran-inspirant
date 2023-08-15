<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

/**
 * @internal
 */
class HelpControllerTest extends TestCase
{
    use RefreshDatabase;

    protected TestResponse $response;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function get_from_route_should_be_accessible(): void
    {
        $this->response = $this->get(route('help'))
            ->assertSuccessful()
            ->assertHeader('Content-Type', 'text/html; charset=UTF-8')
        ;
    }
}
