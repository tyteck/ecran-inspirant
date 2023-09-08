<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\DTO\TailwindColor;
use App\Exceptions\TailwindColorIndexNotDefinedException;
use Tests\TestCase;

/**
 * @internal
 */
class TailwindColorTest extends TestCase
{
    protected array $pink;
    protected array $availableColorIndexes = [
        '50', '100', '200', '300', '400', '500',
        '600', '700', '800', '900', '950',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->pink = [
            '50' => '#fdf2f8',
            '100' => '#fce7f3',
            '200' => '#fbcfe8',
            '300' => '#f9a8d4',
            '400' => '#f472b6',
            '500' => '#ec4899',
            '600' => '#db2777',
            '700' => '#be185d',
            '800' => '#9d174d',
            '900' => '#831843',
            '950' => '#500724',
        ];
    }

    /** @test */
    public function from_array_color_should_fail(): void
    {
        $this->expectException(TailwindColorIndexNotDefinedException::class);
        TailwindColor::fromArray('unknown', ['090' => 'lorem']);
    }

    /** @test */
    public function from_array_color_should_succeed(): void
    {
        $color = TailwindColor::fromArray('pink', $this->pink);
        $this->assertNotNull($color);
        $this->assertInstanceOf(TailwindColor::class, $color);
        $this->assertEquals('pink', $color->name());
    }

    /** @test */
    public function get_light_color_should_succeed(): void
    {
        $color = TailwindColor::fromArray('pink', $this->pink);
        $this->assertEquals($this->pink['100'], $color->light());
    }

    /** @test */
    public function get_dark_color_should_succeed(): void
    {
        $color = TailwindColor::fromArray('pink', $this->pink);
        $this->assertEquals($this->pink['900'], $color->dark());
    }

    /** @test */
    public function get_color_name_should_succeed(): void
    {
        $expectedColor = 'pink';
        $color = TailwindColor::fromArray($expectedColor, $this->pink);
        $this->assertEquals($expectedColor, $color->name());
    }
}
