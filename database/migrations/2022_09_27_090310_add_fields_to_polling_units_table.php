<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToPollingUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('polling_units', function (Blueprint $table) {
            //
            if (!Schema::hasColumn('polling_units', 'registered_voters')) {
                $table->string('registered_voters')->nullable()->after('name');
            }

            if (!Schema::hasColumn('polling_units', 'accredited')) {
                $table->string('accredited')->nullable()->after('name');
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
            if (Schema::hasColumn('polling_units', 'registered_voters')) {
                $table->dropColumn('registered_voters');
            }

            if (Schema::hasColumn('polling_units', 'accredited')) {
                $table->dropColumn('accredited');
            }
        });
    }
}
