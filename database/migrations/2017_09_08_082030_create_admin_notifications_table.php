<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('subject');
            $table->text('description');
            $table->integer('note_id')->unsinged()->nullable()->comment('Note ID if that is a Report for note');
            $table->tinyInteger('is_seen')->default('0')->comment('O means Unseen | 1 means seen');
            $table->tinyInteger('seen_by')->nullable()->comment('Admin ID -> When admin Saw then it will be filled');
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
        Schema::dropIfExists('admin_notifications');
    }
}
