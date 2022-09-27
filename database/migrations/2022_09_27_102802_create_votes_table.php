<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('polling_unit_id');
            $table->foreign('polling_unit_id')->references('id')->on('polling_units')->onDelete('cascade');
            $table->unsignedBigInteger('election_id');
            $table->foreign('election_id')->references('id')->on('elections')->onDelete('cascade');
            $table->integer('ec8as');
            $table->integer('no_of_voters');
            $table->integer('voters_accredited');
            $table->integer('ballot_issued');
            $table->integer('ballot_used');
            $table->integer('rejected_ballot');
            $table->integer('spoilt_ballot');
            $table->integer('votes_cast');
            $table->integer('votes_rejected');
            $table->integer('error');
            $table->softDeletes();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votes');
    }
}
