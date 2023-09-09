<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\DTO\TailwindColor;
use App\Exceptions\TailwindColorNotFoundException;
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
    public function get_unknown_color_should_fail(): void
    {
        $this->expectException(TailwindColorNotFoundException::class);
        TailwindColors::init()->get('unknown');
    }

    /** @test */
    public function get_color_should_succeed(): void
    {
        array_map(function ($color): void {
            $result = TailwindColors::init()->get($color);

            $this->assertNotNull($result);
            $this->assertInstanceOf(TailwindColor::class, $result);
        }, $this->availableColors);
    }

    /** @test */
    public function pick_color_should_succeed(): void
    {
        $result = TailwindColors::init()->getOne();

        $this->assertNotNull($result);
        $this->assertInstanceOf(TailwindColor::class, $result);

        $this->assertTrue(in_array($result->name(), $this->availableColors));
    }
}
