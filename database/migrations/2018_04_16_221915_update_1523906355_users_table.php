<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1523906355UsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            
if (!Schema::hasColumn('users', 'employee_image')) {
                $table->string('employee_image')->nullable();
                }
if (!Schema::hasColumn('users', 'phone_no')) {
                $table->string('phone_no')->nullable();
                }
if (!Schema::hasColumn('users', 'joining_date')) {
                $table->date('joining_date')->nullable();
                }
if (!Schema::hasColumn('users', 'cv')) {
                $table->string('cv')->nullable();
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('employee_image');
            $table->dropColumn('phone_no');
            $table->dropColumn('joining_date');
            $table->dropColumn('cv');
            
        });

    }
}
