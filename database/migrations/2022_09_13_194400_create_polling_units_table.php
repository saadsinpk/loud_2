<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollingUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polling_units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
           // $table->enum('status',['active','inactive'])->default('active');
            $table->unsignedBigInteger('lga_id')->nullable();
            $table->foreign('lga_id')->references('id')->on('lgas')->onDelete('cascade');   
            $table->unsignedBigInteger('wards_id')->nullable();
            $table->foreign('wards_id')->references('id')->on('wards')->onDelete('cascade');  
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
        Schema::dropIfExists('polling_units');
    }
}
