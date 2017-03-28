<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->default(0);
            $table->enum('type', ['topic', 'question', 'answer']);
            $table->integer('object_id');
            $table->float('point', 5, 1);
            $table->text('comments')->nullable();
            $table->datetime('created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('modified');
        });

        Schema::table('votes', function(Blueprint $table) {
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
        Schema::table('votes', function(Blueprint $table) {
            $table->dropForeign('votes_user_id_foreign');
        });

        Schema::drop('votes');
    }
}
