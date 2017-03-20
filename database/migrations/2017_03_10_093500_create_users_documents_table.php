<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_documents', function (Blueprint $table) {
            $table->integer('document_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->primary(['document_id', 'user_id']);
        });

        Schema::table('users_documents', function(Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::table('users_documents', function(Blueprint $table) {
            $table->foreign('document_id')
                ->references('id')
                ->on('documents')
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
        Schema::table('users_documents', function(Blueprint $table) {
            $table->dropForeign('users_documents_user_id_foreign');
        });

        Schema::table('users_documents', function(Blueprint $table) {
            $table->dropForeign('users_documents_topic_id_foreign');
        });

        Schema::drop('users_documents');
    }
}
