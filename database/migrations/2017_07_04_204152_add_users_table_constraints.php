<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsersTableConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('client_id')
                ->unsigned()
                ->nullable();
            $table->integer('office_id')
                ->unsigned()
                ->nullabel();

            $table->foreign('client_id')
                ->references('id')
                ->on('clients');
            $table->foreign('office_id')
                ->references('id')
                ->on('offices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropForeign(['office_id']);
        });
    }
}
