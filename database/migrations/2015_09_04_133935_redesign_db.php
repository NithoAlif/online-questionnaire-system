<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RedesignDb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaire', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps('date_created');
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('questions');
            $table->string('sidenote');
            $table->string('type');
            $table->integer('que_id')->unsigned();
            $table->timestamps('date_created');
        });

        Schema::table('questions', function (Blueprint $table) {
            $table->foreign('que_id')->references('id')->on('questionnaire');
        });

        Schema::create('possible_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('answer');
            $table->integer('q_id')->unsigned();
            $table->timestamps('date_created');
        });

        Schema::table('possible_answers', function (Blueprint $table) {
            $table->foreign('q_id')->references('id')->on('questions');
        });

        Schema::create('responses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('que_id')->unsigned();
            $table->integer('u_id')->unsigned();
            $table->timestamps('date_created');
        });

        Schema::table('responses', function (Blueprint $table) {
            $table->foreign('que_id')->references('id')->on('questionnaire');
            $table->foreign('u_id')->references('id')->on('user_list');
        });

        Schema::create('answers', function (Blueprint $table) {
            $table->integer('res_id')->unsigned();
            $table->integer('q_id')->unsigned();
            $table->string('answer');
            $table->primary(['res_id', 'q_id']);
        });

        Schema::table('answers', function (Blueprint $table) {
            $table->foreign('res_id')->references('id')->on('responses');
            $table->foreign('q_id')->references('id')->on('questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
