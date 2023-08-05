<?php

declare(strict_types=1);

if (!function_exists('generateHash')) {
    function generateHash(): string
    {
        $bytes = random_bytes(8);
        $base64 = base64_encode($bytes);

        return rtrim(strtr($base64, '+/', '-_'), '=');
    }
}

if (!function_exists('chunkText')) {
    function chunkText(string $text, string $separator, int $assemble = 0): array
    {
        $token = strtok($text, $separator);

        $chunks = [];
        while ($token !== false) {
            $chunks[] = trim($token);
            $token = strtok($separator);
        }

        strtok('', ''); // free mem

        if ($assemble === 0) {
            return $chunks;
        }

        $toWorkOn = array_chunk($chunks, $assemble);
        $results = [];
        foreach ($toWorkOn as $items) {
            $results[] = implode(' ', $items);
        }

        return $results;
    }
}

if (!function_exists('chunkSmart')) {
    function chunkSmart(string $text, bool $asString = false, string $glue = PHP_EOL): array|string
    {
        $separators = ",;:.!?\n";
        // check for [,.\n]
        $matches = preg_split("/([^{$separators}]+[{$separators}]+)/", $text, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

        // cleaning
        $cleaned = array_map(fn ($match) => trim($match), $matches);

        if ($asString) {
            return implode($glue, $cleaned);
        }

        return $cleaned;
    }
}

if (!function_exists('getContrastColor')) {
    function getContrastColor(string $hexColor)
    {
        $hexColor = ltrim($hexColor, '#');
        
        // hexColor RGB
        $R1 = hexdec(substr($hexColor, 1, 2));
        $G1 = hexdec(substr($hexColor, 3, 2));
        $B1 = hexdec(substr($hexColor, 5, 2));
        
        // Black RGB
        $blackColor = '#000000';
        $R2BlackColor = hexdec(substr($blackColor, 1, 2));
        $G2BlackColor = hexdec(substr($blackColor, 3, 2));
        $B2BlackColor = hexdec(substr($blackColor, 5, 2));

        // Calc contrast ratio
        $L1 = 0.2126 * pow($R1 / 255, 2.2) +
              0.7152 * pow($G1 / 255, 2.2) +
              0.0722 * pow($B1 / 255, 2.2);

        $L2 = 0.2126 * pow($R2BlackColor / 255, 2.2) +
              0.7152 * pow($G2BlackColor / 255, 2.2) +
              0.0722 * pow($B2BlackColor / 255, 2.2);

        $contrastRatio = 0;
        if ($L1 > $L2) {
            $contrastRatio = (int) (($L1 + 0.05) / ($L2 + 0.05));
        } else {
            $contrastRatio = (int) (($L2 + 0.05) / ($L1 + 0.05));
        }

        // If contrast is more than 5, return black color
        if ($contrastRatio > 5) {
            return '#000000';
        }
        // if not, return white color.
        return '#FFFFFF';
    }
}
