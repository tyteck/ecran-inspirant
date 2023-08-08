<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Exceptions\FontFileDoNotExistsException;
use App\Services\FontPathSelector;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * @internal
 */
class FontPathSelectorTest extends TestCase
{
    protected FontPathSelector $fontPathSelector;
    protected string $fontName = 'Roboto-Regular.ttf';

    public function setUp(): void
    {
        parent::setUp();
        $this->fontPathSelector = new FontPathSelector();
    }

    /** @test */
    public function get_path_should_throw(): void
    {
        $this->expectException(FontFileDoNotExistsException::class);
        $result = $this->fontPathSelector->getPath('unknown');
    }

    /** @test */
    public function get_path_should_get_path(): void
    {
        $result = $this->fontPathSelector->getPath($this->fontName);
        $this->assertNotNull($result);
        $this->assertEquals(Storage::disk('fonts')->path($this->fontName), $result);
    }

    /** @test */
    public function get_one_font(): void
    {
        $availables = array_map(
            fn ($fontFile) => '/app/resources/fonts/' . $fontFile,
            Storage::disk('fonts')->files()
        );

        $result = $this->fontPathSelector->getOneFont();

        $this->assertNotNull($result);
        $this->assertTrue(in_array($result, $availables));
    }
}
