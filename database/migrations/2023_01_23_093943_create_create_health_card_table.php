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
        Schema::create('create_health_card', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('password');
            $table->string('swd');
            $table->string('dob');
            $table->string('blood_group');
            $table->string('address');
            $table->string('assign_state');
            $table->string('assign_district');
            $table->string('pincode');
            $table->string('card_reg_start');
            $table->string('card_reg_end');
            $table->string('aadhar_no');
            $table->string('pan_number');
            $table->string('mobile');
            $table->string('referred_by');
            $table->string('health_card_type');
            $table->string('health_card_amount');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('create_health_card');
    }
};
