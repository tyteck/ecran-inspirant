<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Enums\Colors;
use Tests\TestCase;

/**
 * @internal
 */
class ColorsTest extends TestCase
{
    protected array $expectedColors = ['gray', 'red', 'orange', 'green', 'emerald', 'blue', 'purple', 'pink', 'rose'];

    /** @test */
    public function colors_are_defined(): void
    {
        $result = Colors::values();
        $this->assertNotNull($result);
        $this->assertIsArray($result);
        $this->assertEqualsCanonicalizing($this->expectedColors, $result);
    }

    /** @test */
    public function bg_colors_are_correct(): void
    {
        $expectedColors = [
            'gray' => '#111827',
            'red' => '#7f1d1d',
            'orange' => '#7c2d12',
            'green' => '#14532d',
            'emerald' => '#064e3b',
            'blue' => '#1e3a8a',
            'purple' => '#581c87',
            'pink' => '#831843',
            'rose' => '#881337',
        ];

        array_map(function ($key, $expectedBgColor): void {
            $this->assertEquals($expectedBgColor, Colors::from($key)->bgColor());
        }, array_keys($expectedColors), $expectedColors);
    }

    /** @test */
    public function fg_colors_are_correct(): void
    {
        $expectedColors = [
            'gray' => '#f3f4f6',
            'red' => '#fee2e2',
            'orange' => '#ffedd5',
            'green' => '#dcfce7',
            'emerald' => '#d1fae5',
            'blue' => '#dbeafe',
            'purple' => '#f3e8ff',
            'pink' => '#fce7f3',
            'rose' => '#ffe4e6',
        ];

        array_map(function ($key, $expectedBgColor): void {
            $this->assertEquals($expectedBgColor, Colors::from($key)->fgColor());
        }, array_keys($expectedColors), $expectedColors);
    }

    /** @test */
    public function intermediary_colors_are_correct(): void
    {
        $expectedColors = [
            'gray' => '#9ca3af',
            'red' => '#f87171',
            'orange' => '#fb923c',
            'green' => '#4ade80',
            'emerald' => '#34d399',
            'blue' => '#60a5fa',
            'purple' => '#c084fc',
            'pink' => '#f472b6',
            'rose' => '#fb7185',
        ];

        array_map(function ($key, $expectedBgColor): void {
            $this->assertEquals($expectedBgColor, Colors::from($key)->interColor());
        }, array_keys($expectedColors), $expectedColors);
    }

    /** @test */
    public function random_should_return_enum(): void
    {
        $result = Colors::random();
        $this->assertNotNull($result);
        $this->assertInstanceOf(Colors::class, $result);
        $this->assertTrue(in_array($result->value, $this->expectedColors));
    }

    /** @test */
    public function random_value_should_return_string(): void
    {
        $result = Colors::randomValue();
        $this->assertNotNull($result);
        $this->assertIsString($result);
        $this->assertTrue(in_array($result, $this->expectedColors));
    }
}
