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
        Schema::create('user_title_progress', function (Blueprint $table) {
            $table->id();
            $table->integer('progress')->nullable();
            $table->boolean('completed')->default(false);
            $table->foreignId('user_id')->constrained();
            $table->foreignId('title_requirement_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_title_progress');
    }
};
