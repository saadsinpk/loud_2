<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('profile_picture')->nullable();
            $table->string('otp')->nullable();
            $table->string('otp_sent_on')->nullable();
            $table->string('provider')->nullable();
            $table->text('provider_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_picture');
            $table->dropColumn('otp');
            $table->dropColumn('otp_sent_on');
            $table->dropColumn('provider');
            $table->dropColumn('provider_id');
        });
    }
}
