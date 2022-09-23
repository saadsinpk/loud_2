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

            if (!Schema::hasColumn('users', 'profile_picture')) {
                $table->text('profile_picture')->nullable()->after('email');
            }

            if (!Schema::hasColumn('users', 'otp')) {
                    $table->string('otp')->nullable()->after('email');
            }

            if (!Schema::hasColumn('users', 'otp_sent_on')) {
                    $table->string('otp_sent_on')->nullable()->after('email');
            }

            if (!Schema::hasColumn('users', 'provider')) {
                    $table->string('provider')->nullable()->after('email');
            }

            if (!Schema::hasColumn('users', 'provider_id')) {
                    $table->text('provider_id')->nullable()->after('email');
            }

            if (!Schema::hasColumn('users', 'deleted_at')) {
                    $table->softDeletes()->before('created_at');
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
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'profile_picture')) {
                $table->dropColumn('profile_picture');
            }

            if (Schema::hasColumn('users', 'otp')) {
                $table->dropColumn('otp');
            }

            if (Schema::hasColumn('users', 'otp_sent_on')) {
                $table->dropColumn('otp_sent_on');
            }

            if (Schema::hasColumn('users', 'provider')) {
                $table->dropColumn('provider');
            }

            if (Schema::hasColumn('users', 'provider_id')) {
                $table->dropColumn('provider_id');
            }

            if (Schema::hasColumn('users', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }

        });
    }
}
