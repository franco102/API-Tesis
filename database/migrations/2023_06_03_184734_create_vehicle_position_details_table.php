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
        Schema::create('vehicle_position_details', function (Blueprint $table) {
            $table->id()->constrained()->comment("primary key of vehicules's details positions");
            $table->string('latitude')->nullable()->comment('last latitude gps of vehicle');
            $table->string('longitude')->nullable()->comment('last longitude gps of vehicle');
            $table->dateTime('datetime_divice',$precision=4)->nullable()->comment('date time of the divice');
            $table->dateTime('datetime_servers',$precision=4)->nullable()->comment('date time when divice send information and save in the servers the of BD');
            $table->float('speed')->comment('speed of the vehicule');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_position_details');
    }
};
