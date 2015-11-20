<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('creator_id')->unsigned()->default(1);
            $table->foreign('creator_id')->references('id')->on('users');
            $table->integer('totalSearch')->default(0);
            $table->timestamps();
        });

        Schema::create('subject_user', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('subject_id')->unsigned();
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('progress')->default(0);
            $table->timestamps();
        });

        Schema::create('subject_subject', function(Blueprint $table) {
            $table->integer('main_subject_id')->unsigned();
            $table->foreign('main_subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->integer('recommend_subject_id')->unsigned();
            $table->foreign('recommend_subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->text('intro');
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
        Schema::drop('subject_subject');
        Schema::drop('subject_user');
        Schema::drop('subjects');
    }
}
