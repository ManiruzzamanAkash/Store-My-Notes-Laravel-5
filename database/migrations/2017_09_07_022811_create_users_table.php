<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->string('email', 100)->unique();
            $table->string('username', 30)->unique();
            $table->string('password');
            $table->string('birthdate', 20);
            
            $table->string('bio_title')->nullable();
            $table->string('website')->nullable();
            $table->string('image')->nullable();
            $table->text('bio_description')->nullable();
            $table->string('country', 50)->nullable();
            $table->string('organization')->nullable();
            $table->string('is_active', 2)->default('1')->comment('1 Means User is active | 0 means user is banned');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}