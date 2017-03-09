<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions_tags', function (Blueprint $table) {
            $table->integer('question_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->primary(['question_id', 'tag_id']);
        });

        Schema::table('questions_tags', function(Blueprint $table) {
            $table->foreign('question_id')
                ->references('id')
                ->on('questions')
                ->onDelete('cascade');
        });

        Schema::table('questions_tags', function(Blueprint $table) {
            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
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
        Schema::table('questions_tags', function(Blueprint $table) {
            $table->dropForeign('questions_tags_question_id_foreign');
        });

        Schema::table('questions_tags', function(Blueprint $table) {
            $table->dropForeign('questions_tags_tag_id_foreign');
        });

        Schema::drop('questions_tags');
    }
}
