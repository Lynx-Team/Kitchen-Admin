<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NullableKitchenProfileAttrs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kitchen_profiles', function (Blueprint $table) {
            $table->string('company_name', 200)->nullable()->change();
            $table->string('contact_name', 200)->nullable()->change();
            $table->string('postal_address', 1024)->nullable()->change();
            $table->string('delivery_address', 1024)->nullable()->change();
            $table->string('phone', 50)->nullable()->change();
            $table->string('delivery_instructions', 1024)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kitchen_profiles', function (Blueprint $table) {
            //
        });
    }
}
