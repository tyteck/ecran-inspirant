<?php

declare(strict_types=1);

namespace App\Enums;

use App\Contracts\Resolution;

enum SamsungPresets: string implements Resolution
{
    case GALAXY_8 = 'galaxy8';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function width(): int
    {
        return match ($this) {
            self::GALAXY_8 => 640,
        };
    }

    public function height(): int
    {
        return match ($this) {
            self::GALAXY_8 => 960,
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::GALAXY_8 => 'Samsung Galaxy 8',
        };
    }
}
