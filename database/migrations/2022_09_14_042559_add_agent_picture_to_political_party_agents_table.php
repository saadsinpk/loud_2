<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAgentPictureToPoliticalPartyAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('political_party_agents', function (Blueprint $table) {
            $table->text('agent_picture')->nullable()->after('name');
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
            $table->dropColumn('agent_picture');
        });
    }
}
