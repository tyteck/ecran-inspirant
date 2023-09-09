<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\IphonePresets;
use App\Enums\OtherPresets;
use App\Enums\SamsungPresets;
use App\Services\TailwindColors;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HelpController extends Controller
{
    public function show(): View|Factory
    {
        $pageTitle = 'Aide';

        $presets = array_merge(
            IphonePresets::cases(),
            SamsungPresets::cases(),
            OtherPresets::cases(),
        );

        $colorName = TailwindColors::init()->getOne()->name();

        return view('help')->with([
            'colorName' => $colorName,
            'description' => "Page d'aide afin de récupérer un fond d'écran adapté.",
            'pageTitle' => $pageTitle,
            'presets' => $presets,
        ]);
    }
}
