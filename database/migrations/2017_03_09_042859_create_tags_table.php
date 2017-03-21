<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('user_id')->default(0);
            $table->string('name', 100);
            $table->integer('position');
            $table->unsignedInteger('public')->default(0);
            $table->tinyInteger('del_flg');
            $table->timestamps();
        });

        Schema::table('tags', function(Blueprint $table) {
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
        Schema::table('tags', function(Blueprint $table) {
            $table->dropForeign('tags_user_id_foreign');
        });

        Schema::drop('tags');
    }
}
