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
            $table->char('name', 255);
            $table->char('slug', 255);
            $table->bigInteger('brand_id')->unsigned();
            $table->longText('description')->nullable();
            $table->decimal('price', 12, 2);
            $table->integer('sort')->default(0)->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
            $table->foreign('brand_id')->references('id')->on('brands')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_brand_id_foreign');
        });
        Schema::dropIfExists('products');
    }
}
