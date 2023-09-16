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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->text('address_line1')->nullable();
            $table->text('address_line2')->nullable();
            $table->integer('division_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->string('country_name')->nullable();
            $table->string('zipCode')->nullable();
            $table->timestamps('order_date')->nullable();

            $table->unsignedInteger('total_amount')->nullable();
            $table->unsignedInteger('shipping_amount')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('currency')->nullable();
            $table->string('status')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
