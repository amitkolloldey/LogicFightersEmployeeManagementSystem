<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1523908674SaleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('saleries', function (Blueprint $table) {
            
if (!Schema::hasColumn('saleries', 'month')) {
                $table->string('month')->nullable();
                }
if (!Schema::hasColumn('saleries', 'due')) {
                $table->string('due')->nullable();
                }
if (!Schema::hasColumn('saleries', 'bonus')) {
                $table->string('bonus')->nullable();
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
        Schema::table('saleries', function (Blueprint $table) {
            $table->dropColumn('month');
            $table->dropColumn('due');
            $table->dropColumn('bonus');
            
        });

    }
}
