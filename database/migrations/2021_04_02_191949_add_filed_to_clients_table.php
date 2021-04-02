<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFiledToClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            // $table->index('mobile');
            // $table->index('email');
            // $table->index('name');
            $table->index('username');
            $table->index('birthday');
            $table->index('location');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropIndex('mobile');
            $table->dropIndex('email');
            // $table->dropIndex('name');
            $table->dropIndex('username');
            $table->dropIndex('birthday');
            $table->dropIndex('location');
        });
    }
}
