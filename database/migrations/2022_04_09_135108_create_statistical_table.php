<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatisticalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistical', function (Blueprint $table) {
            $table->Increments('statistical_id');
            $table->double('tonggiatri', 20, 2);
            $table->integer('tongsoluong');
            $table->integer('tongdonhang');
            $table->date('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistical');
    }
}
