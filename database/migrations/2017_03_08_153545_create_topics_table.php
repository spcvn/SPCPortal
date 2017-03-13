<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id')->default(0);
            $table->unsignedInteger('user_id')->default(0);
            $table->string('topic_name', 250);
            $table->string('picture', 250);
            $table->text('description')->nullable();
            $table->unsignedInteger('view')->default(0);
            $table->unsignedInteger('public')->default(1);
            $table->unsignedInteger('del_flag')->default(0);
            $table->datetime('created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('modified');
        });

        Schema::table('topics', function(Blueprint $table) {
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
        Schema::table('topics', function(Blueprint $table) {
            $table->dropForeign('topics_user_id_foreign');
        });

        Schema::drop('topics');
    }
}
