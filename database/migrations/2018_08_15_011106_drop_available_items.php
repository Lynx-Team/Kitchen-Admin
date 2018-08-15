<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropAvailableItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_list_items', function (Blueprint $table) {
            $table->dropForeign(['available_item_id']);
            $table->dropColumn(['available_item_id']);
        });
        Schema::dropIfExists('available_items');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('available_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_list_id');
            $table->foreign('order_list_id')->references('id')->on('order_lists')->onDelete('cascade');
            $table->unsignedInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });
        Schema::table('order_list_items', function (Blueprint $table) {
            $table->unsignedInteger('available_item_id');
            $table->foreign('available_item_id')->references('id')->on('available_items')->onDelete('cascade');
        });
    }
}
