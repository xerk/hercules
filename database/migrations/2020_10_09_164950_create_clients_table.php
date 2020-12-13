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
            $table->bigInteger('unique_id')->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('email', 45)->nullable();
            $table->string('name', 100)->nullable();
            $table->string('username')->nullable();
            $table->string('religion', 45)->nullable();
            $table->string('birthday', 45)->nullable();
            $table->string('work')->nullable();
            $table->string('position')->nullable();
            $table->string('hometown')->nullable();
            $table->string('location')->nullable();
            $table->string('education')->nullable();
            $table->string('relationship')->nullable();
            $table->string('nationality', 20)->nullable();

            $table->index(['unique_id',
                               'religion',
                               'work',
                               'position',
                               'education',
                               'relationship', 'hometown']);
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
