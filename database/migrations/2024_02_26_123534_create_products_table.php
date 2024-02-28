<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('feet_id')->nullable();
            $table->foreign('feet_id')->references('id')->on('product_feets')->onDelete('cascade')->nullable();
            $table->string('price')->nullable();
            $table->string('thumbnail')->nullable();
            $table->text('images')->nullable();
            $table->string('body_color')->nullable();
            $table->string('pancha_saree_color')->nullable();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id')->references('id')->on('product_types')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->integer('model');
            $table->integer('stock')->default(0);
            $table->integer('status')->default(1);
            $table->integer('id_deleted')->default(0);
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
        Schema::dropIfExists('products');
    }
}
