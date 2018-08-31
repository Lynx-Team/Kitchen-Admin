<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKitchenProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kitchen_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kitchen_id');
            $table->foreign('kitchen_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('company_name', 200);
            $table->string('contact_name', 200);
            $table->string('postal_address', 1024);
            $table->string('delivery_address', 1024);
            $table->string('phone', 50);
            $table->string('delivery_instructions', 1024);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kitchen_profiles');
    }
}
