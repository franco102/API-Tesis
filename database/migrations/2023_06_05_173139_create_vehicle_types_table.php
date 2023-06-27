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
        Schema::create('vehicle_types', function (Blueprint $table) {
            $table->id()->constrained()->comment('primary key  type of vehicules');
            $table->string('name')->comment('name  type of vehicle');
            $table->string('icon')->comment('icon type of vehicle');
            $table->boolean('is_active')->default(true)->comment('if the vehicule is active 1, if is not active is 0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_types');
    }
};
