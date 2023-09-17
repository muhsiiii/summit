<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->increments('id');
      $table->enum('type', ['Admin','User'])->default('User');
      $table->string('name', 64)->default('');
      $table->string('phone', 13)->default('');
      $table->string('email', 64)->default('');
      $table->string('password', 64)->default('');
      $table->string('device_id', 128)->default('');
      $table->enum('status', ['Active', 'Pending', 'Suspended', 'Deleted'])->default('Pending');
      $table->string('logo', 128)->default('');
      $table->rememberToken();
      $table->timestamps();
    });

    DB::table('users')->insert([
      'type' => 'Admin',
      'name' => 'SuperAdmin',
      'email' => 'SuperAdmin@gmail.com',
      'password' => md5('SuperAdmin@SMT#5465'),
      'phone' => '',
      'status' => 'Active',
      'created_at' => date('Y-m-d H:i:00'),
      'updated_at' => date('Y-m-d H:i:00'),
    ]);

    DB::table('users')->insert([
      'type' => 'Admin',
      'name' => 'ADARSHJOSE',
      'email' => 'SuperAdmin@gmail.com',
      'password' => md5('ADARSHJOSE'),
      'phone' => '',
      'status' => 'Active',
      'created_at' => date('Y-m-d H:i:00'),
      'updated_at' => date('Y-m-d H:i:00'),
    ]);
  }

  public function down()
  {
    Schema::dropIfExists('users');
  }
}
