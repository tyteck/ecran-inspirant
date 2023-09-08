<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\DTO\TailwindColor;
use App\Services\TailwindColors;
use Tests\TestCase;

/**
 * @internal
 */
class TailwindColorsTest extends TestCase
{
    protected array $availableColorIndexes = [
        '50', '100', '200', '300', '400', '500',
        '600', '700', '800', '900', '950',
    ];
    protected array $availableColors = [
        'slate', 'gray', 'zinc', 'neutral', 'stone', 'red', 'orange', 'amber',
        'yellow', 'lime', 'green', 'emerald', 'teal', 'cyan', 'sky', 'blue',
        'indigo', 'violet', 'purple', 'fuchsia', 'pink', 'rose',
    ];

    /** @test */
    public function pick_one_should_succeed(): void
    {
        $result = TailwindColors::init()->getOne();

        $this->assertNotNull($result);
        $this->assertTrue(in_array($result, $this->availableColors));
    }

    /** @test */
    public function get_color_should_succeed(): void
    {
        $result = TailwindColors::init()->get('emerald');

        $this->assertNotNull($result);
        $this->assertInstanceOf(TailwindColor::class, $result);
    }

    /** @test */
    public function pick_color_should_succeed(): void
    {
        $result = TailwindColors::init()->pickOne();

        $this->assertNotNull($result);
        $this->assertIsArray($result);

        $this->assertTrue(in_array($result, $this->availableColors));
    }
}
