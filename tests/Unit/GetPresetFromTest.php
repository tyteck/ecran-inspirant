<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Enums\IphonePresets;
use App\Enums\SamsungPresets;
use App\Services\GetPresetFrom;
use Tests\TestCase;

/**
 * @internal
 */
class GetPresetFromTest extends TestCase
{
    /** @test */
    public function unknown_preset_should_return_null(): void
    {
        $this->assertNull(GetPresetFrom::from('unknown')->get());
    }

    /** @test */
    public function iphone8_preset_should_return_good_preset(): void
    {
        $result = GetPresetFrom::from('iphone8')->get();

        $this->assertNotNull($result);
        $this->assertInstanceOf(IphonePresets::class, $result);

        $this->assertEquals(IphonePresets::IPHONE_8, $result);
        $this->assertEquals('iphone8', $result->value);
        $this->assertEquals('iPhone 8', $result->label());
    }

    /**
     * @test
     */
    public function valid_iphone_preset_should_return_good_preset(): void
    {
        $presets = [
            'iphone14+', 'iphone14promax', 'iphone14pro', 'iphone14', 'iphone13pro', 'iphone13promax', 'iphone13mini',
            'iphone13', 'iphone12pro', 'iphone12promax', 'iphone12mini', 'iphone12', 'iphone11promax', 'iphone11pro',
            'iphone11', 'iphonexr', 'iphonexsmax', 'iphonexs', 'iphonex', 'iphone8+', 'iphone8', 'iphone7+', 'iphone7',
            'iphone6+', 'iphone6', 'iphone6s+', 'iphone6s', 'iphone5c', 'iphone5s', 'iphone5', 'iphone4s', 'iphone4',
            'iphonese3', 'iphonese2', 'iphonese1',
        ];
        array_map(
            function (string $preset): void {
                $result = GetPresetFrom::from($preset)->get();

                $this->assertNotNull($result);
                $this->assertInstanceOf(IphonePresets::class, $result);
            },
            $presets
        );
    }

    /**
     * @test
     */
    public function valid_samsung_preset_should_return_good_preset(): void
    {
        $presets = [
            'galaxy8',
        ];
        array_map(
            function (string $preset): void {
                $result = GetPresetFrom::from($preset)->get();

                $this->assertNotNull($result);
                $this->assertInstanceOf(SamsungPresets::class, $result);
            },
            $presets
        );
    }
}
