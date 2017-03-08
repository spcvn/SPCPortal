<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->default(0);
            $table->unsignedInteger('user_id')->default(0);
            $table->string('name', 250);
            $table->text('description')->nullable();
            $table->unsignedInteger('del_flag')->default(0);
            $table->unsignedInteger('position')->default(0);
            $table->datetime('created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('modified');
        });

        Schema::table('categories', function(Blueprint $table) {
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
        Schema::table('categories', function(Blueprint $table) {
            $table->dropForeign('categories_user_id_foreign');
        });

        Schema::drop('categories');
    }
}
