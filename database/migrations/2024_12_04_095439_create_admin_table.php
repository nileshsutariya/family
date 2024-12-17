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
        Schema::create('admin', function (Blueprint $table) {
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
            $table->date('date_of_birth');
            $table->string('blood_group');
            $table->string('c_address');
            $table->string('c_district');
            $table->string('c_taluka');
            $table->string('c_village');
            $table->string('v_address');
            $table->string('v_district');
            $table->string('v_taluka');
            $table->string('v_village');
            $table->string('education')->nullable();
            $table->string('profession');
            $table->string('company_name')->nullable();
            $table->string('business_category')->nullable();
            $table->string('document')->nullable();
            $table->string('document_upload')->nullable();
            $table->string('profile_photo')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('approve_status')->default(1)->comment('1 is Approved , 0 is Pending');
            $table->rememberToken();        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
