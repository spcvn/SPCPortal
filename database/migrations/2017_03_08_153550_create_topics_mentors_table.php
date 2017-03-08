<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsMentorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics_mentors', function (Blueprint $table) {
            $table->integer('topic_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->primary(['topic_id', 'user_id']);
        });

        Schema::table('topics_mentors', function(Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::table('topics_mentors', function(Blueprint $table) {
            $table->foreign('topic_id')
                ->references('id')
                ->on('topics')
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
        Schema::table('topics_mentors', function(Blueprint $table) {
            $table->dropForeign('topics_mentors_user_id_foreign');
        });

        Schema::table('topics_mentors', function(Blueprint $table) {
            $table->dropForeign('topics_mentors_topic_id_foreign');
        });

        Schema::drop('topics_mentors');
    }
}
