<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserNormalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('user_normal', function (Blueprint $table) {
            $table->increments('user_type_id');
            $table->string('email')->nullable();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('user_type_name')->default('Student');
            $table->string('gender');
            $table->string('degree');
            $table->integer('year_of_study');
            $table->float('grade',4,2);
            $table->float('exam_grade',4,2);
            $table->float('bac_grade',4,2);
            $table->integer('dorm_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_normal');
    }
}
