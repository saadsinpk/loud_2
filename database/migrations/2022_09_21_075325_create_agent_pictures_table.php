<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentPicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_pictures', function (Blueprint $table) {
            $table->id();
            $table->text('path');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('political_party_agent_id')->nullable();
            $table->foreign('political_party_agent_id')->references('id')->on('political_party_agents')->onDelete('cascade'); 
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
        Schema::dropIfExists('agent_pictures');
    }
}
