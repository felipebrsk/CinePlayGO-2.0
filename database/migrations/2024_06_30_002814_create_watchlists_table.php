<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('watchlists', function (Blueprint $table) {
            $table->id();
            $table->float('rate');
            $table->string('name');
            $table->string('link');
            $table->string('image');
            $table->unsignedInteger('tmdb_id');
            $table->boolean('watched')->default(false);
            $table->foreignId('user_id')->constrained();
            $table->foreignId('media_type_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('watchlists');
    }
};
