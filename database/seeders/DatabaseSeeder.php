<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // These seeders are used every time
        Model::unguard();

        $requiredSeeders = [
            QuotesTableSeeder::class,
        ];

        $additionalSeeders = [];
        if (App::environment(['local'])) {
            $additionalSeeders = [
            ];
        }

        $seeders = array_merge($requiredSeeders, $additionalSeeders);
        $this->call($seeders);
        Model::reguard();
    }
}
