<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\TailwindColor;
use Illuminate\Support\Facades\File;

class TailwindColors
{
    protected array $colors = [];

    private function __construct()
    {
        $colorsFromFile = json_decode(File::get(resource_path('js/colors.json')), true);
        array_map(
            fn ($color, $values) => $this->colors[$color] = TailwindColor::fromArray($color, $values),
            array_keys($colorsFromFile),
            $colorsFromFile
        );
    }

    public static function init(...$params)
    {
        return new static(...$params);
    }

    public function getOne(): string
    {
        $keys = array_keys($this->colors);

        return $keys[array_rand($keys)];
    }

    public function get(string $colorToGet): TailwindColor
    {
        throw_if
        return
    }
}
