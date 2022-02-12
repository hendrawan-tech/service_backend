<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 8);
            $table->string('name', 100);
            $table->string('brand', 30);
            $table->string('condition');
            $table->string('attribute');
            $table->string('problem');
            $table->text('specification');
            $table->string('image')->nullable();
            $table->enum('status', ['Diterima', 'Diperbaiki', 'Selesai', 'Dikembalikan']);
            $table->unsignedBigInteger('product_category_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_services');
    }
}
