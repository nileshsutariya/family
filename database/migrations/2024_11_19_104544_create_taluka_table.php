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
        Schema::create('taluka', function (Blueprint $table) {
            $table->id();
            $table->string('taluka');
            $table->unsignedBigInteger('district')->nullable();
            $table->foreign('district')->references('id')->on('district')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taluka');
    }
};
