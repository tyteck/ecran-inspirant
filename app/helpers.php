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
    function chunkSmart(string $text): array
    {
        $separators = ",;:.!?\n";
        // check for [,.\n]
        $matches = preg_split("/([^{$separators}]+[{$separators}]+)/", $text, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

        // cleaning
        return array_map(fn ($match) => trim($match), $matches);
    }
}
