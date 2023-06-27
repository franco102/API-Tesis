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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id()->constrained()->comment('primary key of the vehicules');
            $table->string('license_plate')->comment('license plate of the vehicles');
            $table->string('brand')->comment('brand of the vehicles');
            $table->string('number_motor')->comment('number motor of the vehicles');
            $table->string('color')->comment('color  of the vehicles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
