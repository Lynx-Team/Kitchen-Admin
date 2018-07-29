<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompletedToOrderListAndItsItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_list_items', function (Blueprint $table) {
            $table->boolean('completed')->default(false);
        });
        Schema::table('order_lists', function (Blueprint $table) {
            $table->boolean('completed')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_list_items', function (Blueprint $table) {
            $table->dropColumn(['completed']);
        });
        Schema::table('order_lists', function (Blueprint $table) {
            $table->dropColumn(['completed']);
        });
    }
}
