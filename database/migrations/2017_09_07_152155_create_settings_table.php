<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('site_title');
            $table->string('site_description')->nullable();
            $table->text('site_meta_keywords')->nullable();
            $table->text('site_meta_description')->nullable();
            $table->string('site_logo')->nullable();
            $table->unsignedTinyInteger('admin_id');
            $table->unsignedTinyInteger('site_description_visible')->default(0);
            $table->unsignedTinyInteger('home_min_note');
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
        Schema::dropIfExists('settings');
    }
}