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
        Schema::create('employeers', function (Blueprint $table) {
            $table->id()->constrained()->comment('primary key of the employeers');
            $table->string('name')->comment('names of the employers');
            $table->string('lastname')->comment('lastnames of the employers');
            $table->string('dni')->unique()->comment('dni of the employers');
            $table->string('photo')->nullable()->comment('photo of the employers');
            $table->string('ruc')->unique()->nullable()->comment('ruc of the employers');
            $table->string('phone')->comment('phone route of the employers');
            $table->string('addres')->comment('addres of the employers');
            $table->date('birthday')->comment('birthday of the employers');
            $table->string('email')->unique()->comment('email of the employers');
            $table->boolean('is_active')->deafult(true)->comment('if is active of the employers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employeers');
    }
};
