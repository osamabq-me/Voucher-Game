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
            if (!Schema::hasColumn('users', 'github_id')) {
                $table->string('github_id')->nullable()->unique();
            }
            if (!Schema::hasColumn('users', 'github_name')) {
                $table->string('github_name')->nullable();
            }
            if (!Schema::hasColumn('users', 'github_username')) {
                $table->string('github_username')->nullable();
            }
            if (!Schema::hasColumn('users', 'github_token')) {
                $table->string('github_token')->nullable();
            }
            if (!Schema::hasColumn('users', 'github_refresh_token')) {
                $table->string('github_refresh_token')->nullable();
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
            if (Schema::hasColumn('users', 'github_id')) {
                $table->dropColumn('github_id');
            }
            if (Schema::hasColumn('users', 'github_name')) {
                $table->dropColumn('github_name');
            }
            if (Schema::hasColumn('users', 'github_username')) {
                $table->dropColumn('github_username');
            }
            if (Schema::hasColumn('users', 'github_token')) {
                $table->dropColumn('github_token');
            }
            if (Schema::hasColumn('users', 'github_refresh_token')) {
                $table->dropColumn('github_refresh_token');
            }
        });
    }
}
