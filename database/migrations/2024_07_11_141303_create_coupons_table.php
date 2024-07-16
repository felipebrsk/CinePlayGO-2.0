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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->integer('value');
            $table->date('expiry_date');
            $table->string('code')->unique();
            $table->boolean('active')->default(true);
            $table->integer('min_value')->nullable();
            $table->boolean('single_use')->default(true);
            $table->boolean('first_purchase')->default(false);
            $table->foreignId('coupon_type_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
