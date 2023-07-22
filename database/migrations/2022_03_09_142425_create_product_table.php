<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->string('tensanpham', 100);
            $table->string('hinhsanpham', 255);
            $table->double('gia', 20, 2);
            $table->integer('soluong');
            $table->integer('soluongban')->default(0);
            $table->integer('luotxem')->default(0);
            $table->longtext('mota');
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
        Schema::dropIfExists('product');
    }
}
