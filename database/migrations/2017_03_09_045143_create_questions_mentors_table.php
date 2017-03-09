<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsMentorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions_mentors', function (Blueprint $table) {
            $table->integer('question_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->primary(['question_id', 'user_id']);
        });

        Schema::table('questions_mentors', function(Blueprint $table) {
            $table->foreign('question_id')
                ->references('id')
                ->on('questions')
                ->onDelete('cascade');
        });

        Schema::table('questions_mentors', function(Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions_mentors', function(Blueprint $table) {
            $table->dropForeign('questions_mentors_question_id_foreign');
        });

        Schema::table('questions_mentors', function(Blueprint $table) {
            $table->dropForeign('questions_mentors_user_id_foreign');
        });

        Schema::drop('questions_mentors');
    }
}
