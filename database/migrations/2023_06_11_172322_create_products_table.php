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
            $table->string('title')->unique();
            $table->string('slug')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('is_featured')->default(0)->comment('0=Neg, 1=Pos');
            $table->integer('regular_price')->nullable();
            $table->integer('offer_price')->nullable();
            $table->integer('quantity')->nullable();
            $table->text('short_desc')->nullable();
            $table->text('long_desc')->nullable();
            $table->integer('status')->default(1)->comment('0=Inactive, 1=Active');
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
