<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    public static function getOne()
    {
        $item = self::query()
            ->inRandomOrder()
            ->take(1)
            ->select('text', 'source')
            ->first()
        ;

        return $item['text'] . ' (' . $item['source'] . ')';
    }
}
