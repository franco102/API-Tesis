<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * ->default(1) valuedefault
     * ->comment('my comment') commet of the attribute;
     * ->nullable() if you want that attribute can be nullable 
     * ->renameColumn('from', 'to') rename attribute
     * ->dropColumn('votes') drop, multiple attributes  $table->dropColumn(['votes', 'avatar', 'location']);
     * ->unique(); only the attribute can be unique
     * ->language('english') specified language
     * ->constrained()
     * ->onUpdate('cascade')
     * ->onDelete('cascade')
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id()->constrained()->comment('primary key of the services');
            $table->string('name')->comment('some title or name of the services');
            $table->dateTime('init_date', $precision = 4)->comment('init date of the service swith precision of 4');
            $table->dateTime('end_date', $precision = 4)->comment('end date of the service swith precision of 4');
            $table->boolean('is_active')->deafult(true)->comment('if is active  of the services');
            $table->float('price')->comment('price total of the service');
            $table->string('description')->nullable()->comment('some discription of the services, can be nullable');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
