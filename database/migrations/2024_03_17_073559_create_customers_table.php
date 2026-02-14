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
            $table->unsignedBigInteger('price_list_id');
            $table->foreign('price_list_id')->references('id')->on('price_lists');
            $table->string('name', 50)->unique();
            $table->string('color_id',50);
            $table->foreign('color_id')->references('id')->on('colors');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('sessions_id');
            $table->foreign('sessions_id')->references('id')->on('sessions');
            $table->enum('status', ['Lunas', 'Belum Lunas'])->default('Belum Lunas');
             $table->integer('created_by')->nullable();
            $table->dateTime('created_date')->nullable();
            $table->integer('updated_by')->nullable();
            $table->dateTime('updated_date')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->dateTime('deleted_date')->nullable();
            $table->enum('is_deleted', ['Y', 'N'])->default('N');
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
