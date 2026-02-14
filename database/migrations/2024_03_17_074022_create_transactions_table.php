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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->bigInteger('cash');
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
        Schema::dropIfExists('transactions');
    }
};
