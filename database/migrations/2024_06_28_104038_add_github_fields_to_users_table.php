<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGithubFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('github_id')->nullable()->unique();
            $table->string('github_name')->nullable();
            $table->string('github_username')->nullable();
            $table->string('github_token')->nullable();
            $table->string('github_refresh_token')->nullable();
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
            $table->dropColumn('github_id');
            $table->dropColumn('github_name');
            $table->dropColumn('github_username');
            $table->dropColumn('github_token');
            $table->dropColumn('github_refresh_token');
        });
    }
}
