<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorrectScheme extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->unsignedInteger('cost');
        });
        Schema::table('order_list_items', function (Blueprint $table) {
            $table->dropColumn('cost');
            $table->integer('supplier_sort_order')->default(0)->change();
            $table->integer('kitchen_sort_order')->default(0)->change();
            $table->unsignedInteger('avaiable_item_id');
            $table->foreign('avaiable_item_id')->references('id')->on('available_item_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('cost');
        });
        Schema::table('order_list_items', function (Blueprint $table) {
            $table->integer('kitchen_sort_order')->default(NULL)->change();
            $table->integer('supplier_sort_order')->default(NULL)->change();
            $table->unsignedInteger('cost');
            $table->dropForeign(['available_item_id']);
            $table->dropColumn(['available_item_id']);
        });
    }
}
