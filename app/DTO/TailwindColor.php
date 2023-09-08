<?php

declare(strict_types=1);

namespace App\DTO;

use App\Exceptions\TailwindColorIndexNotDefinedException;

/**
 * one tailwind color is a pack indexed with its name (emerald)
 * and its color indexes '50', '100', ..., '900'.
 */
class TailwindColor
{
    protected string $index_50;
    protected string $index_100;
    protected string $index_200;
    protected string $index_300;
    protected string $index_400;
    protected string $index_500;
    protected string $index_600;
    protected string $index_700;
    protected string $index_800;
    protected string $index_900;
    protected string $index_950;

    private function __construct(protected string $colorName, array $colors)
    {
        array_map(function ($key, $value): void {
            $prop = "index_{$key}";
            throw_unless(
                property_exists($this, $prop),
                new TailwindColorIndexNotDefinedException("This property {$prop} do not exists.")
            );
            $this->{$prop} = $value;
        }, array_keys($colors), $colors);
    }

    public static function fromArray(...$params)
    {
        return new static(...$params);
    }

    public function light(): string
    {
        return $this->index_100;
    }

    public function dark(): string
    {
        return $this->index_900;
    }

    public function name(): string
    {
        return $this->colorName;
    }
}
