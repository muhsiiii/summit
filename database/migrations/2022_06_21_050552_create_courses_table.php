<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cat_id')->default(1);
            $table->string('name', 128)->default('');
            $table->integer('duration')->default(1);
            $table->float('amount')->default(0);
            $table->float('offer_amount')->default(0);
            $table->text('keyword')->nullable();
            $table->text('content')->nullable();
            $table->string('overview', 2048)->default('');
            $table->string('desc', 2048)->default('');
            $table->string('highlight', 2048)->default('');
            $table->string('notes', 2048)->default('');
            $table->string('image', 128)->default('');
            $table->enum('status', ['Active', 'Suspended', 'Deleted'])->default('Suspended');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
