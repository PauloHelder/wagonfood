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
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->unsignedBigInteger('tenant_id');
            $table->string('title');
            $table->string('flag')->unique();
            $table->string('image');
            $table->double('price',10,2);
            $table->text('description');
            $table->timestamps();

            $table->foreign('tenant_id')
                        ->references('id')
                        ->on('tenants')
                        ->onUpdate('cascade')
                        ->onDelete('cascade');
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('product_id');

            $table->foreign('category_id')
                        ->references('id')
                        ->on('categories')
                        ->onUpdate('cascade')
                        ->onDelete('cascade');

            $table->foreign('product_id')
                        ->references('id')
                        ->on('products')
                        ->onUpdate('cascade')
                        ->onDelete('cascade');

           
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
