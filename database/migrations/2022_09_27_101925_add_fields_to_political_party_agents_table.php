<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToPoliticalPartyAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('political_party_agents', function (Blueprint $table) {
            $table->unsignedBigInteger('constituency_id')->nullable()->after('signature_electoral_officer');
            $table->foreign('constituency_id')->references('id')->on('constituencies')->onDelete('cascade');

            $table->unsignedBigInteger('party_id')->nullable()->after('signature_electoral_officer');
            $table->foreign('party_id')->references('id')->on('parties')->onDelete('cascade');
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
            $table->dropConstrainedForeignId('constituency_id');
            $table->dropConstrainedForeignId('parties');
        });
    }
}
