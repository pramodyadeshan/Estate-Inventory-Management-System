<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->integer('qty')->nullable(false);
            $table->double('buy_price',8,2);
            $table->double('sell_price',8,2);
            $table->string('manu_date')->nullable();
            $table->string('exp_date')->nullable();
            $table->unsignedTinyInteger('isActive');
            $table->string('cate_id');
            $table->string('img_id');
            $table->string('user_id');
            $table->unsignedBigInteger('division_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
