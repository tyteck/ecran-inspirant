<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\IphonePresets;
use App\Enums\OtherPresets;
use App\Enums\SamsungPresets;
use App\Http\Controllers\Traits\Color;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HelpController extends Controller
{
    use Color;

    public function show(): View|Factory
    {
        $pageTitle = 'Aide';

        $presets = array_merge(
            IphonePresets::cases(),
            SamsungPresets::cases(),
            OtherPresets::cases(),
        );

        return view('help')->with([
            'color' => $this->randomColor(),
            'description' => "Page d'aide afin de récupérer un fond d'écran adapté.",
            'pageTitle' => $pageTitle,
            'presets' => $presets,
        ]);
    }
}
