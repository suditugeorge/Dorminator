<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDbstatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dbstats', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('start')->default(false);
            $table->boolean('end')->default(false);
            $table->boolean('can_operate')->default(true);
            $table->string('algorithm')->default('preference');
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
        Schema::dropIfExists('dbstats');
    }
}
