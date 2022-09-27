<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToPartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parties', function (Blueprint $table) {
            //
            if (!Schema::hasColumn('parties', 'flag')) {
                $table->string('flag')->nullable()->after('name');
            }

            if (!Schema::hasColumn('parties', 'sign')) {
                $table->text('sign')->nullable()->after('name');
            }

            if (!Schema::hasColumn('parties', 'color')) {
                $table->text('color')->nullable()->after('name');
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
        Schema::table('parties', function (Blueprint $table) {
            if (Schema::hasColumn('parties', 'flag')) {
                $table->dropColumn('flag');
            }

            if (Schema::hasColumn('parties', 'sign')) {
                $table->dropColumn('sign');
            }

            if (Schema::hasColumn('parties', 'color')) {
                $table->dropColumn('color');
            }
        });
    }
}
