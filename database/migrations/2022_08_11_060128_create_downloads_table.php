<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDownloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('downloads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->string('name', 128)->default('');
            $table->string('desc', 512)->default('');
            $table->text('keyword')->nullable();
            $table->text('content')->nullable();
            $table->enum('type', ['Files', 'Folders'])->default('Folders');
            $table->enum('file_type', ['PDF', 'URL'])->default('PDF');
            $table->string('file_url', 128)->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('downloads');
    }
}
