<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1523907255ProjectManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_managements', function (Blueprint $table) {
            
if (!Schema::hasColumn('project_managements', 'comment')) {
                $table->text('comment')->nullable();
                }
if (!Schema::hasColumn('project_managements', 'project_status')) {
                $table->string('project_status')->nullable();
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
        Schema::table('project_managements', function (Blueprint $table) {
            $table->dropColumn('comment');
            $table->dropColumn('project_status');
            
        });

    }
}
