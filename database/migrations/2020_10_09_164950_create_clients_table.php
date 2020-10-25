<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id');
            $table->string('mobile');
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->string('religion')->nullable();
            $table->string('birthday')->nullable();
            $table->string('work')->nullable();
            $table->string('position')->nullable();
            $table->string('hometown')->nullable();
            $table->string('location')->nullable();
            $table->string('education')->nullable();
            $table->string('relationship')->nullable();
            $table->string('nationality');

            // Timestamps
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
