<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('answers', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('question_id')->default(0);
            $table->unsignedInteger('user_id')->default(0);
            $table->text('comment');
            $table->tinyInteger('del_flg');
            $table->timestamps();
        });

       Schema::table('answers', function(Blueprint $table) {
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
        Schema::table('answers', function(Blueprint $table) {
            $table->dropForeign('answers_user_id_foreign');
        });

        Schema::drop('answers');
    }
}
