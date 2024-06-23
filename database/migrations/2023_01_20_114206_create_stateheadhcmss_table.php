<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stateheadhcmss', function (Blueprint $table) {
            $table->id();
           $table->string('name');
           $table->string('image');
           $table->string('mobile_no');
           $table->string('email');
           $table->string('dob');
           $table->string('gender');
           $table->string('aadhar_no');
           $table->string('pan_no');
           $table->string('father_name');
           $table->string('referred_by');
           $table->string('assign_state');
           $table->string('state');
           $table->string('district');
           $table->string('city');
           $table->string('street');
           $table->string('pincode');
           $table->string('country');
           $table->string('password');
           $table->string('bank_name');
           $table->string('account_no');
           $table->string('ifsc_code');
           $table->string('account_holder_name');
           $table->string('amount');
           $table->string('commission');
           $table->string('payment_mode');
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stateheadhcmss');
    }
};
