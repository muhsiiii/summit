<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicsContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('topic_id')->default(1);
            $table->string('name', 128)->default('');
            $table->enum('type', ['Video', 'Notes', 'Questions', 'Audio'])->default('Notes');
            $table->string('url', 128)->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics_contents');
    }
}
