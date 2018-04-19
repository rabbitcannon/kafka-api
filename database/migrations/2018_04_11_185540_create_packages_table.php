<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('services_id')->index();
            $table->unsignedInteger('notification_type_id')->index();
            $table->unsignedInteger('notification_frequencies_id')->index();
            $table->unsignedInteger('notification_method_id')->index();
        });

        Schema::table('packages', function (Blueprint $table) {
            $table->foreign('services_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('packages');
        Schema::enableForeignKeyConstraints();

    }
}
