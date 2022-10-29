<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('attribute_values', function (Blueprint $table) {
        //     $table->id(); 
        //     $table->bigInteger('product_attribute_id')->unsigned()->nullable();
        //     $table->string('value');
        //     $table->integer('product_id')->nullable();
        //     $table->timestamps();
        //     $table->softDeletes();
        //     $table->foreign('product_attribute_id')->references('id')->on('product_attribute')->onDelete('cascade');
        //     $table->foreign('product_id')->references('product_id')->on('product')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_values');
    }
};
