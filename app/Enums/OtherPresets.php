<?php

declare(strict_types=1);

namespace App\Enums;

use App\Contracts\Resolution;

enum OtherPresets: string implements Resolution
{
    case SD = 'sd';

    case HD = 'hd';

    case FULL_HD = 'fullhd';

    case FOUR_K = '4k';

    case EIGHT_K = '8k';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function width(): int
    {
        return match ($this) {
            self::SD => 720,
            self::HD => 1280,
            self::FULL_HD => 1920,
            self::FOUR_K => 3840,
            self::EIGHT_K => 7680,
        };
    }

    public function height(): int
    {
        return match ($this) {
            self::SD => 480,
            self::HD => 720,
            self::FULL_HD => 1080,
            self::FOUR_K => 2160,
            self::EIGHT_K => 4320,
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::SD => 'SD, définition standard, qualité DVD',
            self::HD => 'HDTV, HD 720p, 720p, HD Ready',
            self::FULL_HD => 'HDTV 1080p, HD 1080p, 1080p, Full HD',
            self::FOUR_K => '4K, UHD 4K, Ultra HD 4K, UHD-4K, 2160p',
            self::EIGHT_K => '8K, UHD 8K, Ultra HD 8K, UHD-8K, 4320p',
        };
    }
}
