<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToPoliticalPartyAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('political_party_agents', function (Blueprint $table) {
            if (!Schema::hasColumn('political_party_agents', 'slug')) {
                $table->string('slug')->nullable()->after('last_name');
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
        Schema::table('political_party_agents', function (Blueprint $table) {
            if (Schema::hasColumn('political_party_agents', 'slug')) {
                $table->dropColumn('slug');
            }
        });
    }
}
