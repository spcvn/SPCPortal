<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('topic_id')->default(0);
            $table->unsignedInteger('user_id')->default(0);
            $table->string('title', 255);
            $table->text('description');
            $table->integer('views');
            $table->unsignedInteger('public')->default(0);
            $table->tinyInteger('del_flg');
            $table->timestamps();
        });

        Schema::table('questions', function(Blueprint $table) {
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
        Schema::table('questions', function(Blueprint $table) {
            $table->dropForeign('questions_user_id_foreign');
        });

        Schema::drop('questions');
    }
}
