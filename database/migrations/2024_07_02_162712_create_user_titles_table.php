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
        Schema::create('user_titles', function (Blueprint $table) {
            $table->id();
            $table->boolean('in_use')->default(false);
            $table->foreignId('user_id')->constrained();
            $table->foreignId('title_id')->constrained();
            $table->timestamp('acquired_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_titles');
    }
};
