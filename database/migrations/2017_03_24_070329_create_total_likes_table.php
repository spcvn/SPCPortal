<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTotalLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('total_likes', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('question_id')->default(0);
            $table->integer('likes')->default(0);
            $table->integer('dislike')->default(0);
            $table->timestamps();
        });

       Schema::table('total_likes', function(Blueprint $table) {
            $table->foreign('question_id')
                ->references('id')
                ->on('questions')
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
        Schema::table('total_likes', function(Blueprint $table) {
            $table->dropForeign('total_likes_question_id_foreign');
        });

        Schema::drop('total_likes');
    }
}
