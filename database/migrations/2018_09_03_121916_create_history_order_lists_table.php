<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryOrderListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_order_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('note');
            $table->date('last_update_date');
            $table->unsignedInteger('order_list_id')->nullable()->default(null);
            $table->foreign('order_list_id')->references('id')->on('order_lists')->onDelete('set null');
            $table->unsignedInteger('customer_id')->nullable()->default(null);
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('set null');
            $table->unsignedInteger('kitchen_id')->nullable()->default(null);
            $table->foreign('kitchen_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_order_lists');
    }
}
