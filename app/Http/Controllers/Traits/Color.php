<?php

declare(strict_types=1);

namespace App\Http\Controllers\Traits;

use App\Enums\Colors;

trait Color
{
    public function randomColor(): Colors
    {
        return Colors::random();
    }
}
