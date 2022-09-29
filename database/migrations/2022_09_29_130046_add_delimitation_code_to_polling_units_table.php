<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDelimitationCodeToPollingUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('polling_units', function (Blueprint $table) {
            if (!Schema::hasColumn('polling_units', 'delimitation_code')) {
                $table->string('delimitation_code')->nullable()->after('name');
                $table->unsignedBigInteger('state_id')->nullable()->after('name');
                $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
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
            Schema::table('polling_units', function (Blueprint $table) {
                if (Schema::hasColumn('polling_units', 'delimitation_code')) {
                    $table->dropColumn('delimitation_code');
                    $table->dropConstrainedForeignId('state_id');
                }
            });
        });
    }
}
