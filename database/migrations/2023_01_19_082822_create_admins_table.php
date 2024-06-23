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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->integer('state_head_hcms_id');
            $table->integer('district_head_hcms_id');
            $table->integer('city_head_hcms_id');
            $table->integer('district_admin_id');
            $table->integer('delivery_boy_id');
            $table->string('mobile');
            $table->string('email');
            $table->string('commission');
            $table->string('amount');
            $table->string('password');
            $table->string('image');
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
        Schema::dropIfExists('admins');
    }
};
