<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * colors are inspired from tailwindCss (https://tailwindcss.com/docs/customizing-colors)
 * bgColor is the 900 (gray-900)
 * fgColor is the 100 (blue-100).
 * intermediaryColor is the 700 (red-700).
 */
enum Colors: string
{
    case GRAY = 'gray';

    case RED = 'red';

    case ORANGE = 'orange';

    case GREEN = 'green';

    case EMERALD = 'emerald';

    case BLUE = 'blue';

    case PURPLE = 'purple';

    case PINK = 'pink';

    case ROSE = 'rose';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function bgColor(): string
    {
        return match ($this) {
            self::GRAY => '#111827',
            self::RED => '#7f1d1d',
            self::ORANGE => '#7c2d12',
            self::GREEN => '#14532d',
            self::EMERALD => '#064e3b',
            self::BLUE => '#1e3a8a',
            self::PURPLE => '#581c87',
            self::PINK => '#831843',
            self::ROSE => '#881337',
        };
    }

    public function fgColor(): string
    {
        return match ($this) {
            self::GRAY => '#f3f4f6',
            self::RED => '#fee2e2',
            self::ORANGE => '#ffedd5',
            self::GREEN => '#dcfce7',
            self::EMERALD => '#d1fae5',
            self::BLUE => '#dbeafe',
            self::PURPLE => '#f3e8ff',
            self::PINK => '#fce7f3',
            self::ROSE => '#ffe4e6',
        };
    }

    public function interColor(): string
    {
        return match ($this) {
            self::GRAY => '#9ca3af',
            self::RED => '#f87171',
            self::ORANGE => '#fb923c',
            self::GREEN => '#4ade80',
            self::EMERALD => '#34d399',
            self::BLUE => '#60a5fa',
            self::PURPLE => '#c084fc',
            self::PINK => '#f472b6',
            self::ROSE => '#fb7185',
        };
    }

    public static function randomValue(): string
    {
        return self::values()[array_rand(self::values())];
    }

    public static function random(): self
    {
        return self::from(self::randomValue());
    }
}
