<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocalGovernmentToPollingUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('polling_units', function (Blueprint $table) {
            if (!Schema::hasColumn('polling_units', 'local_government')) {
                $table->text('local_government')->nullable()->after('name');
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
        Schema::table('polling_units', function (Blueprint $table) {
            if (Schema::hasColumn('polling_units', 'local_government')) {
                $table->dropColumn('local_government');
            }
        });
    }
}
