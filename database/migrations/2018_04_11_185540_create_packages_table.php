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
            $table->foreign('services_id')
                ->references('id')
                ->on('services');
            $table->unsignedInteger('notification_type_id')->index();
            $table->foreign('notification_type_id')
                ->references('id')
                ->on('notification_types');
            $table->unsignedInteger('notification_frequencies_id')->index();
            $table->foreign('notification_frequencies_id')
                ->references('id')
                ->on('notification_frequencies');
            $table->unsignedInteger('notification_method_id')->index();
            $table->foreign('notification_method_id')
                ->references('id')
                ->on('notification_methods');
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

        Schema::table('packages', function (Blueprint $table) {
            $table->dropForeign(['services_id', 'notification_type_id', 'notification_frequencies_id', 'notification_method_id']);
        });

        Schema::dropIfExists('packages');
    }
}
