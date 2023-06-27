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
        Schema::create('states', function (Blueprint $table) {
            $table->id()->constrained()->comment('primary key of the states');;
            $table->string('name')->comment('name state');
            $table->string('color')->comment('color state');
            $table->string('icon')->comment('icon state');
            $table->boolean('is_active')->deafult(true)->comment('if is active state');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};
