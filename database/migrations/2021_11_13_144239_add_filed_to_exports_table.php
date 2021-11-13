<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFiledToExportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exports', function (Blueprint $table) {
            DB::statement("ALTER TABLE exports MODIFY COLUMN status ENUM('processing', 'completed', 'failed') NOT NULL DEFAULT 'processing'");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exports', function (Blueprint $table) {
            DB::statement("ALTER TABLE exports MODIFY COLUMN status ENUM('processing', 'completed') NOT NULL DEFAULT 'processing'");
        });
    }
}
