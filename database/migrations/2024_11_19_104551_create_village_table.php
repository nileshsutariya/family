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
        Schema::create('village', function (Blueprint $table) {
            $table->id();
            $table->string('village');
            $table->unsignedBigInteger('district')->nullable();
            $table->foreign('district')->references('id')->on('district')->onDelete('cascade');
            $table->unsignedBigInteger('taluka')->nullable();
            $table->foreign('taluka')->references('id')->on('taluka')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('village');
    }
};
