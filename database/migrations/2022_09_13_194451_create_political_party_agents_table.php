<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoliticalPartyAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('political_party_agents', function (Blueprint $table) {
            $table->id();
            $table->string('political_party');
            $table->string('name');
            $table->unsignedBigInteger('lga_id')->nullable();
            $table->foreign('lga_id')->references('id')->on('lgas')->onDelete('cascade');   
            $table->unsignedBigInteger('wards_id')->nullable();
            $table->foreign('wards_id')->references('id')->on('wards')->onDelete('cascade');   
            $table->unsignedBigInteger('polling_unit_id')->nullable();
            $table->foreign('polling_unit_id')->references('id')->on('polling_units')->onDelete('cascade'); 
            $table->text('designation');
            $table->text('home_address');
            $table->text('mobile');
            $table->text('extra_mobile')->nullable();
            $table->boolean('signature_agent')->default(0);
            $table->boolean('signature_auth_party_officials')->default(0);
            $table->text('name_party_chairman');
            $table->boolean('signature_party_chairman')->default(0);
            $table->text('name_electoral_officer')->nullable();
            $table->boolean('signature_electoral_officer')->default(0);
          //  $table->enum('status',['active','inactive'])->default('active');
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
        Schema::dropIfExists('political_party_agents');
    }
}
