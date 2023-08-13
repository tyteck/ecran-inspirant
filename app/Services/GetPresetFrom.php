<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\IphonePresets;
use App\Enums\OtherPresets;
use App\Enums\SamsungPresets;
use ValueError;

class GetPresetFrom
{
    protected array $availablePresets = [
        IphonePresets::class,
        SamsungPresets::class,
        OtherPresets::class,
    ];

    private function __construct(protected string $presetName)
    {
        // code
    }

    public static function from(...$params)
    {
        return new static(...$params);
    }

    public function get(): null|IphonePresets|SamsungPresets|OtherPresets
    {
        foreach ($this->availablePresets as $potentialPreset) {
            try {
                return $potentialPreset::from($this->presetName);
            } catch (ValueError $thrown) {
                // doing nothing
            }
        }

        return null;
    }
}
