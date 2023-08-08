<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\FontFileDoNotExistsException;
use Illuminate\Support\Facades\Storage;

class FontPathSelector
{
    protected array $availableFonts = [];

    public function __construct()
    {
        $this->availableFonts = Storage::disk('fonts')->files();
    }

    public function getPath(string $fontName): string
    {
        throw_unless(
            Storage::disk('fonts')->exists($fontName),
            new FontFileDoNotExistsException("Font {$fontName} do not exists.")
        );

        return Storage::disk('fonts')->path($fontName);
    }

    public function getOneFont(): string
    {
        return $this->getPath($this->availableFonts[array_rand($this->availableFonts)]);
    }
}
