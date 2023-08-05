<?php

declare(strict_types=1);

/**
 * laravel database migration : creating the categories table.
 *
 * @author Frederick Tyteca <fred@podmytube.com>
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// laravel database migration : create categories table.
return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table): void {
                $table->increments('id');
                $table->string('parent_id');
                $table->string('name');
                $table->string('slug');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
