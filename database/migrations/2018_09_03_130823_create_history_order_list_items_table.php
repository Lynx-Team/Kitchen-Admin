<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryOrderListItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_order_list_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('short_name', 200);
            $table->string('long_name', 500);
            $table->string('supplier_name', 200);
            $table->unsignedInteger('quantity');
            $table->integer('total_cost');
            $table->string('product_code', 100);
            $table->string('unit', 100);
            $table->unsignedInteger('history_order_list_id')->nullable()->default(null);
            $table->foreign('history_order_list_id')->references('id')
                ->on('history_order_lists')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_order_list_items');
    }
}
