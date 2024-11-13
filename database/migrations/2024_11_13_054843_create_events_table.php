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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('event_date');
            $table->time('event_time');
            $table->string('address');
            $table->unsignedBigInteger('organizer');
            $table->foreign('organizer')->references('id')->on('users')->onUpdate("cascade")->onDelete("cascade");
            $table->string('notes')->nullable();
            $table->string('banner')->nullable();
            $table->string('event_status')->default(0)->comment('0 is Upcoming , 1 is Ongoing , 2 is Complete , 3 is Cancelled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
