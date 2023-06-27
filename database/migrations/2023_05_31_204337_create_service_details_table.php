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
        Schema::create('service_details', function (Blueprint $table) {
            $table->id()->constrained()->comment('primary key of the service details');
            $table->string('init_point')->comment('init point of the service details');
            $table->string('end_point')->comment('end point of the service details');
            $table->datetime('pickup_date',$precision=4)->comment('date of pickup of the product');
            $table->datetime('delivery_date',$precision=4)->comment('date of deliver of the product');
            $table->text('description')->nullable()->comment('description of the sub-service');
            $table->float('price')->comment('prices of the sub-service');
            $table->string('photo')->nullable()->comment('photo of the sub-service');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_details');
    }
};
