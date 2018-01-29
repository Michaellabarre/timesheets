<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteTasktypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('quote_tasktype', function (Blueprint $table) {
            
            $table->integer('quote_id')->unsigned();
            $table->integer('tasktype_id')->unsigned();
            $table->integer('quoted_hours')->unsigned();            

            $table->unique(['quote_id','tasktype_id']);
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');
            $table->foreign('tasktype_id')->references('id')->on('tasktypes')->onDelete('cascade');

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
        Schema::dropIfExists('quote_tasktype');
    }
}
