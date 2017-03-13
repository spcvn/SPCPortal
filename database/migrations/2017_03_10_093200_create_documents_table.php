<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('topic_id')->default(0);
            $table->string('title', 250)->nullable();
            $table->string('file_name', 250)->nullable();
            $table->string('file_path', 250)->nullable();
            $table->unsignedInteger('del_flag')->default(0);
            $table->datetime('created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('modified');
        });

        Schema::table('documents', function(Blueprint $table) {
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
        Schema::table('documents', function(Blueprint $table) {
            $table->dropForeign('documents_topic_id_foreign');
        });

        Schema::drop('documents');
    }
}
