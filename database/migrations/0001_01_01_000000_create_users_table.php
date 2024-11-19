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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('elder')->comment('0 is yes , 1 is no');
            $table->string('elder_ph_no')->nullable();
            $table->string('ph_no');
            $table->string('password');
            $table->string('first_name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('last_name');
            $table->string('marital_status')->comment('0 is married, 1 is engaged, 2 is unmarried, 3 is widow/divorcee');
            $table->string('spouse_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('gender');
            $table->date('date_of_birth')->nullable();
            $table->string('age');
            $table->string('blood_group');
            $table->string('current_address');
            $table->string('current_district');
            $table->string('current_taluka');
            $table->string('current_village')->nullable();
            $table->string('village_address');
            $table->string('village_district');
            $table->string('village_taluka');
            $table->string('village');
            $table->string('education')->nullable();
            $table->string('profession');
            $table->string('company_name')->nullable();
            $table->string('business_category')->nullable();
            
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('role_type')->default(0)->comment('0 is user , 1 is admin');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
