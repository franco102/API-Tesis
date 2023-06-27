<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicle_positions', function (Blueprint $table) {
            $table->id()->constrained()->comment('primary key of the vehicules positions');
            $table->string('last_latitude')->nullable()->comment('last latitude gps of vehicle');
            $table->string('last_longitude')->nullable()->comment('last longitude gps of vehicle');
            $table->dateTime('datetime_divice',$precision=4)->nullable()->comment('date time of the divice');
            $table->dateTime('datetime_servers',$precision=4)->nullable()->comment('date time when divice send information and save in the servers the of BD');
            $table->string('id_android')->comment('id android of the divice');
            $table->string('version_android')->comment('version of the  android of the divice');
            $table->string('ip_address')->comment('ip address of the divice');
            $table->boolean('is_logeed')->default(true)->comment('is attribute if the employeer is logged with divice');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_positions');
    }
};
