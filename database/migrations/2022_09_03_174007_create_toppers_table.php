<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToppersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toppers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('disp_order')->default(1);
            $table->integer('rank')->default(1);
            $table->string('name', 64)->default('');
            $table->string('heading', 128)->default('');
            $table->string('image', 128)->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('toppers');
    }
}
