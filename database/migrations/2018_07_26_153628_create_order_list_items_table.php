<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderListItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_list_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cost');
            $table->unsignedInteger('quantity');
            $table->integer('supplier_sort_order');
            $table->integer('kitchen_sort_order');
            $table->unsignedInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->unsignedInteger('order_list_id');
            $table->foreign('order_list_id')->references('id')->on('order_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_list_items');
    }
}
