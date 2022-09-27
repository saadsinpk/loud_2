<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submission_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('political_party_agent_id');
            $table->foreign('political_party_agent_id')->references('id')->on('political_party_agents')->onDelete('cascade');
            $table->unsignedBigInteger('vote_id');
            $table->foreign('vote_id')->references('id')->on('votes')->onDelete('cascade');
            $table->integer('votes');
            $table->integer('submitted_by');
            $table->dateTime('submitted_at');
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
        Schema::dropIfExists('submission_histories');
    }
}
