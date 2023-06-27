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
        Schema::create('customers', function (Blueprint $table) {
            $table->id()->constrained()->comment('primary key of the customers');
            $table->string('name')->comment('name of the customers');
            $table->string('document')->unique()->comment('document of the customers');
            $table->boolean('document_type')->comment('document type if 1 is DNI if 2 is RUC of the customers');
            $table->string('photo')->nullable()->comment('photo ruote of the customers');
            $table->string('phone')->comment('phone of the customers');
            $table->string('email')->comment('email of the customers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
