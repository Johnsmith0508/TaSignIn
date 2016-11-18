<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("studentTimeTable",function(Blueprint $table){
          $table->integer('studentID');
          $table->integer('timeOut');
          $table->integer('timeIn');
          $table->boolean('unconfirmed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("studentTimeTable");
    }
}
