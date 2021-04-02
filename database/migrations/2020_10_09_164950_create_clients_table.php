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
            $table->bigInteger('unique_id')->nullable()->index();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->string('religion')->nullable()->index();
            $table->string('birthday')->nullable()->index();
            $table->string('work')->nullable()->index();
            $table->string('position')->nullable()->index();
            $table->string('hometown')->nullable()->index();
            $table->string('gender')->nullable()->index();
            $table->string('location')->nullable();
            $table->string('education')->nullable()->index();
            $table->string('relationship')->nullable()->index();
            $table->string('nationality', 20)->nullable()->index();

            // Timestamps
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
        Schema::dropIfExists('clients');
    }
}
