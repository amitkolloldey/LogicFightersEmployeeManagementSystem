<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1523907837AttandancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attandances', function (Blueprint $table) {
            
if (!Schema::hasColumn('attandances', 'attendance')) {
                $table->string('attendance')->nullable();
                }
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attandances', function (Blueprint $table) {
            $table->dropColumn('attendance');
            
        });

    }
}
