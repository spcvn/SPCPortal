<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics_tags', function (Blueprint $table) {
            $table->integer('topic_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->primary(['topic_id', 'tag_id']);
        });

        Schema::table('topics_tags', function(Blueprint $table) {
            $table->foreign('topic_id')
                ->references('id')
                ->on('topics')
                ->onDelete('cascade');
        });

        Schema::table('topics_tags', function(Blueprint $table) {
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
        Schema::table('topics_tags', function(Blueprint $table) {
            $table->dropForeign('topics_tags_question_id_foreign');
        });

        Schema::table('topics_tags', function(Blueprint $table) {
            $table->dropForeign('topics_tags_tag_id_foreign');
        });

        Schema::drop('topics_tags');
    }
}
