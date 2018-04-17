<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_user', function (Blueprint $table) {
            $table->unsignedInteger('package_id')->index();
            $table->foreign('package_id')
                ->references('id')
                ->on('packages');
            $table->unsignedInteger('user_id')->index();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('package_user', function (Blueprint $table) {
            $table->dropForeign(['package_id', 'user_id']);
        });

        Schema::dropIfExists('package_user');
    }
}
