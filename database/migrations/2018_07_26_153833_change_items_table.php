<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn(['quantity', 'cost', 'supplier_sort_order', 'kitchen_sort_order']);
            $table->dropForeign(['supplier_id']);
            $table->dropForeign(['order_list_id']);
            $table->unsignedInteger('default_supplier_id');
            $table->foreign('default_supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->unsignedInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('item_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
