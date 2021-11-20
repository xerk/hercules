<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index()->nullable();
            $table->string('name')->nullable();
            $table->string('group')->nullable();
            $table->string('status')->nullable();
            $table->string('count')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_groups');
    }
}
