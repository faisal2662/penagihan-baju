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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 50)->unique();
            $table->string('slug_price_list');
            $table->foreign('slug_price_list')->references('slug')->on('price_lists');
            $table->string('name', 50)->unique();
            $table->string('slug_color',50);
            $table->foreign('slug_color')->references('slug')->on('colors');
            $table->string('slug_category',50);
            $table->foreign('slug_category')->references('slug')->on('categories');
            $table->string('slug_session',50);
            $table->foreign('slug_session')->references('slug')->on('sessions');
            $table->enum('status', ['Lunas', 'Belum Lunas'])->default('Belum Lunas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};