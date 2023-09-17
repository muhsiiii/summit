<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('marquee', 512)->default('');
            $table->text('why_submit')->nullable();
            $table->string('footer_desc', 256)->default('');
            $table->string('footer_about', 512)->default('');
            $table->string('footer_mobile', 16)->default('');
            $table->string('footer_email', 64)->default('');
            $table->string('footer_address', 512)->default('');
            $table->string('google_play', 256)->default('');
            $table->string('app_store', 256)->default('');
            $table->string('facebook_link', 256)->default('');
            $table->string('whatsapp_number', 256)->default('');
            $table->string('instagram_link', 256)->default('');
            $table->string('telegram_link', 256)->default('');
            $table->text('home_keyword')->nullable();
            $table->text('home_content')->nullable();
            $table->text('about_keyword')->nullable();
            $table->text('about_content')->nullable();
            $table->string('about_desc', 256)->default('');
            $table->text('courses_keyword')->nullable();
            $table->text('courses_content')->nullable();
            $table->string('courses_desc', 256)->default('');
            $table->text('downloads_keyword')->nullable();
            $table->text('downloads_content')->nullable();
            $table->string('downloads_desc', 256)->default('');
            $table->text('quiz_keyword')->nullable();
            $table->text('quiz_content')->nullable();
            $table->string('quiz_desc', 256)->default('');
            $table->text('toppers_keyword')->nullable();
            $table->text('toppers_content')->nullable();
            $table->string('toppers_desc', 256)->default('');
            $table->text('gallery_keyword')->nullable();
            $table->text('gallery_content')->nullable();
            $table->string('gallery_desc', 256)->default('');
            $table->text('contact_keyword')->nullable();
            $table->text('contact_content')->nullable();
            $table->string('contact_desc', 256)->default('');
            $table->binary('contact_page_contents')->nullable();
        });

        DB::table('settings')->insert([
        'marquee' => '',
        'why_submit' => '',
        'footer_desc' => '',
        'footer_about' => '',
        'footer_mobile' => '',
        'footer_email' => '',
        'footer_address' => '',
        'google_play' => '',
        'app_store' => '',
        'facebook_link' => '',
        'whatsapp_number' => '',
        'instagram_link' => ''
      ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
