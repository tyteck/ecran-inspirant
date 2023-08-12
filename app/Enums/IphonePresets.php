<?php

declare(strict_types=1);

namespace App\Enums;

use App\Contracts\Resolution;

enum IphonePresets: string implements Resolution
{
    case IPHONE_14_PLUS = 'iphone14+';

    case IPHONE_14_PRO_MAX = 'iphone14promax';

    case IPHONE_14_PRO = 'iphone14pro';

    case IPHONE_14 = 'iphone14';

    case IPHONE_13_PRO = 'iphone13pro';

    case IPHONE_13_PRO_MAX = 'iphone13promax';

    case IPHONE_13_MINI = 'iphone13mini';

    case IPHONE_13 = 'iphone13';

    case IPHONE_12_PRO = 'iphone12pro';

    case IPHONE_12_PRO_MAX = 'iphone12promax';

    case IPHONE_12_MINI = 'iphone12mini';

    case IPHONE_12 = 'iphone12';

    case IPHONE_11_PRO_MAX = 'iphone11promax';

    case IPHONE_11_PRO = 'iphone11pro';

    case IPHONE_11 = 'iphone11';

    case IPHONE_XR = 'iphonexr';

    case IPHONE_XS_MAX = 'iphonexsmax';

    case IPHONE_XS = 'iphonexs';

    case IPHONE_X = 'iphonex';

    case IPHONE_8_PLUS = 'iphone8+';

    case IPHONE_8 = 'iphone8';

    case IPHONE_7_PLUS = 'iphone7+';

    case IPHONE_7 = 'iphone7';

    case IPHONE_6_PLUS = 'iphone6+';

    case IPHONE_6 = 'iphone6';

    case IPHONE_6S_PLUS = 'iphone6s+';

    case IPHONE_6S = 'iphone6s';

    case IPHONE_5C = 'iphone5c';

    case IPHONE_5S = 'iphone5s';

    case IPHONE_5 = 'iphone5';

    case IPHONE_4S = 'iphone4s';

    case IPHONE_4 = 'iphone4';

    case IPHONE_SE3 = 'iphonese3';

    case IPHONE_SE2 = 'iphonese2';

    case IPHONE_SE1 = 'iphonese1';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function width(): int
    {
        return match ($this) {
            self::IPHONE_13_PRO_MAX,
            self::IPHONE_12_PRO_MAX,
            self::IPHONE_14_PLUS => 1284,

            self::IPHONE_14_PRO_MAX => 1290,

            self::IPHONE_14_PRO => 1179,

            self::IPHONE_14 ,
            self::IPHONE_13_PRO,
            self::IPHONE_13,
            self::IPHONE_12_PRO,
            self::IPHONE_12 => 1170,

            self::IPHONE_11,
            self::IPHONE_XR => 828,

            self::IPHONE_11_PRO_MAX,
            self::IPHONE_XS_MAX => 1242,

            self::IPHONE_11_PRO,
            self::IPHONE_XS,
            self::IPHONE_X => 1125,

            self::IPHONE_13_MINI,
            self::IPHONE_12_MINI,
            self::IPHONE_8_PLUS,
            self::IPHONE_7_PLUS,
            self::IPHONE_6_PLUS,
            self::IPHONE_6S_PLUS => 1080,

            self::IPHONE_SE3,
            self::IPHONE_SE2,
            self::IPHONE_8,
            self::IPHONE_7,
            self::IPHONE_6,
            self::IPHONE_6S => 750,

            self::IPHONE_SE1,
            self::IPHONE_5S,
            self::IPHONE_5C,
            self::IPHONE_5,
            self::IPHONE_4S,
            self::IPHONE_4 => 640,
        };
    }

    public function height(): int
    {
        return match ($this) {
            self::IPHONE_14_PRO_MAX => 2796,

            self::IPHONE_14_PLUS,
            self::IPHONE_13_PRO_MAX,
            self::IPHONE_12_PRO_MAX => 2778,

            self::IPHONE_11_PRO_MAX,
            self::IPHONE_XS_MAX => 2688,

            self::IPHONE_14_PRO => 2556,

            self::IPHONE_13,
            self::IPHONE_13_PRO,
            self::IPHONE_12,
            self::IPHONE_12_PRO,
            self::IPHONE_14 => 2532,

            self::IPHONE_11_PRO,
            self::IPHONE_XS,
            self::IPHONE_X => 2436,

            self::IPHONE_12_MINI,
            self::IPHONE_13_MINI => 2340,

            self::IPHONE_8_PLUS,
            self::IPHONE_7_PLUS,
            self::IPHONE_6S_PLUS,
            self::IPHONE_6_PLUS => 1920,

            self::IPHONE_11,
            self::IPHONE_XR => 1792,

            self::IPHONE_SE3,
            self::IPHONE_SE2,
            self::IPHONE_8,
            self::IPHONE_7,
            self::IPHONE_6S,
            self::IPHONE_6 => 1334,

            self::IPHONE_SE1,
            self::IPHONE_5S,
            self::IPHONE_5C,
            self::IPHONE_5 => 1136,

            self::IPHONE_4S,
            self::IPHONE_4 => 960,
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::IPHONE_14_PLUS => 'iPhone 14 Plus',
            self::IPHONE_14_PRO_MAX => 'iPhone 14 Pro Max',
            self::IPHONE_14_PRO => 'iPhone 14 Pro',
            self::IPHONE_14 => 'iPhone 14',
            self::IPHONE_13_PRO => 'iPhone 13 pro',
            self::IPHONE_13_PRO_MAX => 'iPhone 13 Pro Max',
            self::IPHONE_13_MINI => 'iPhone 13 Mini',
            self::IPHONE_13 => 'iPhone 13',
            self::IPHONE_12_PRO => 'iPhone 12 pro',
            self::IPHONE_12_PRO_MAX => 'iPhone 12 Pro Max',
            self::IPHONE_12_MINI => 'iPhone 12 Mini',
            self::IPHONE_12 => 'iPhone 12',
            self::IPHONE_11_PRO_MAX => 'iPhone 11 Pro Max',
            self::IPHONE_11_PRO => 'iPhone 11 Pro',
            self::IPHONE_11 => 'iPhone 11',
            self::IPHONE_XR => 'iPhone XR',
            self::IPHONE_XS_MAX => 'iPhone XS Max',
            self::IPHONE_XS => 'iPhone XS',
            self::IPHONE_X => 'iPhone X',
            self::IPHONE_8_PLUS => 'iPhone 8+',
            self::IPHONE_8 => 'iPhone 8',
            self::IPHONE_7_PLUS => 'iPhone 7+',
            self::IPHONE_7 => 'iPhone 7',
            self::IPHONE_6_PLUS => 'iPhone 6+',
            self::IPHONE_6 => 'iPhone 6',
            self::IPHONE_6S_PLUS => 'iPhone 6S+',
            self::IPHONE_6S => 'iPhone 6S',
            self::IPHONE_5C => 'iPhone 5C',
            self::IPHONE_5S => 'iPhone 5S',
            self::IPHONE_5 => 'iPhone 5',
            self::IPHONE_4S => 'iPhone 4S',
            self::IPHONE_4 => 'iPhone 4',
            self::IPHONE_SE3 => 'iPhone SE 3ème génération',
            self::IPHONE_SE2 => 'iPhone SE 2ème génération',
            self::IPHONE_SE1 => 'iPhone SE 1ere génération',
        };
    }
}
