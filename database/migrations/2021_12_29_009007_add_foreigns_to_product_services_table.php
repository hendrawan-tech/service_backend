<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToProductServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_services', function (Blueprint $table) {
            $table
                ->foreign('product_category_id')
                ->references('id')
                ->on('product_service_categories')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_services', function (Blueprint $table) {
            $table->dropForeign(['product_category_id']);
            $table->dropForeign(['user_id']);
        });
    }
}
