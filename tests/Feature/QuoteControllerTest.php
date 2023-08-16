<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Quote;
use App\Services\GetPresetFrom;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;
use Tests\Traits\ImageExpectations;

/**
 * @internal
 */
class QuoteControllerTest extends TestCase
{
    use RefreshDatabase;
    use ImageExpectations;

    protected TestResponse $response;
    protected int $defaultWidth;
    protected int $defaultHeight;

    public function setUp(): void
    {
        parent::setUp();
        Quote::factory()->create(['text' => 'Je pense, donc je suis.', 'source' => 'René Descartes']);

        $preset = GetPresetFrom::from('iphone11')->get();
        $this->defaultWidth = $preset->width();
        $this->defaultHeight = $preset->height();
    }

    /** @test */
    public function get_from_route_should_be_accessible(): void
    {
        $this->response = $this->get(route('createPicture'))
            ->assertSuccessful()
            ->assertHeader('Content-Type', 'image/jpeg')
        ;
        $this->checkImageExpectations($this->response->content(), $this->defaultWidth, $this->defaultHeight);
    }

    /** @test */
    public function get_from_url_should_be_accessible(): void
    {
        $this->response = $this->get('http://get.' . config('app.domain'))
            ->assertSuccessful()
            ->assertHeader('Content-Type', 'image/jpeg')
        ;

        $this->checkImageExpectations($this->response->content(), $this->defaultWidth, $this->defaultHeight);
    }

    /** @test */
    public function get_specific_width_and_height_from_url_should_be_accessible(): void
    {
        $this->response = $this->get('http://get.' . config('app.domain') . '/300/300')
            ->assertSuccessful()
            ->assertHeader('Content-Type', 'image/jpeg')
        ;

        $this->checkImageExpectations($this->response->content(), $this->defaultWidth, $this->defaultHeight);
    }

    /** @test */
    public function get_invalid_dimension_should_get_minimal(): void
    {
        $expectedHeight = 1000;
        $this->response = $this->get('http://get.' . config('app.domain') . "/10/{$expectedHeight}")
            ->assertSuccessful()
            ->assertHeader('Content-Type', 'image/jpeg')
        ;

        $this->checkImageExpectations($this->response->content(), $this->defaultWidth, $expectedHeight);
    }

    /**
     * @test
     *
     * @dataProvider providePresets
     */
    public function get_should_accept_presets(string $presetName, int $expectedWidth, int $expectedHeight): void
    {
        $this->response = $this->get('http://get.' . config('app.domain') . "/{$presetName}")
            ->assertSuccessful()
            ->assertHeader('Content-Type', 'image/jpeg')
        ;
        $this->checkImageExpectations($this->response->content(), $expectedWidth, $expectedHeight);
    }

    /*
    |--------------------------------------------------------------------------
    | helpers & providers
    |--------------------------------------------------------------------------
    */
    public static function providePresets(): array
    {
        return [
            'iPhone 14+' => ['iphone14+', 1284, 2778],
            'iPhone 13' => ['iphone13', 1170, 2532],
            'iPhone 13 mini' => ['iphone13mini', 1080, 2340],
            'iPhone 12 Pro Max' => ['iphone12promax', 1284, 2778],
            'iPhone 11 Pro Max' => ['iphone11promax', 1242, 2688],
            'iPhone 11' => ['iphone11', 828, 1792],
            'iPhone XS' => ['iphonexs', 1125, 2436],
            'iPhone X' => ['iphonex', 1125, 2436],
            'iPhone 8 Plus' => ['iphone8+', 1080, 1920],
            'iPhone 8' => ['iphone8', 750, 1334],
            'iPhone 7' => ['iphone7', 750, 1334],
            'iPhone 5C' => ['iphone5c', 640, 1136],
            'iPhone 5S' => ['iphone5s', 640, 1136],
            'iPhone 5' => ['iphone5', 640, 1136],
            'iPhone SE 1st gen' => ['iphonese1', 640, 1136],

            'Samsung Galaxy 8' => ['galaxy8', 640, 960],
        ];
    }
}
