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
     * ->foreignId('country_id')->after('name')->references('id')->on('countries') add foreign key
     */
    public function up(): void
    {
        # add foreign key of the table departments with countries
        Schema::table('departments', function (Blueprint $table){
            $table->foreignId('country_id')->after('name')->references('id')->on('countries');
        });
        # add foreign key of the table provinces with departaments
        Schema::table('provinces', function (Blueprint $table){
            $table->foreignId('departament_id')->after('name')->references('id')->on('departments');
        });
        # add foreign key of the table districts with provinces
        Schema::table('districts', function (Blueprint $table){
            $table->foreignId('province_id')->after('name')->references('id')->on('provinces');
        });

        # add foreign key of the table states with types states
        Schema::table('states', function (Blueprint $table){
            $table->foreignId('state_type_id')->after('is_active')->references('id')->on('state_types');
        });
        # add foreign key of the table users  with employeers
        Schema::table('users', function (Blueprint $table){
            $table->foreignId('employeer_id')->after('password')->references('id')->on('employeers');
        });
        # add foreign key of the table services  with customers, states and employeers
        Schema::table('services', function (Blueprint $table){
            $table->foreignId('customer_id')->after('description')->references('id')->on('customers');
            $table->foreignId('employeer_id')->after('customer_id')->references('id')->on('employeers');
            $table->foreignId('state_id')->after('employeer_id')->references('id')->on('states');
        });
        # add foreign key of the table service_details  with services, states and vehicles
        Schema::table('service_details', function (Blueprint $table){
            $table->foreignId('init_reference_id')->after('init_point')->references('id')->on('districts');
            $table->foreignId('end_reference_id')->after('end_point')->references('id')->on('districts');

            $table->foreignId('service_id')->after('photo')->references('id')->on('customers');
            $table->foreignId('vehicle_id')->after('service_id')->references('id')->on('vehicles');
            $table->foreignId('state_id')->after('vehicle_id')->references('id')->on('states');
        });
        # add foreign key of the table vehicles  with types of vehicles and states
        Schema::table('vehicles', function (Blueprint $table){
            $table->foreignId('vehicle_type_id')->after('color')->references('id')->on('vehicle_types');
            $table->foreignId('state_id')->after('vehicle_type_id')->references('id')->on('states');
        });
        # add foreign key of the table vehicle_positions with vehicules
        Schema::table('vehicle_positions', function (Blueprint $table){
            $table->foreignId('vehicule_id')->after('is_logeed')->references('id')->on('vehicles');
        });
        // # add foreign key of the table vehicle_position_details with vehicle_positions 
        Schema::table('vehicle_position_details', function (Blueprint $table){
            $table->foreignId('vehicle_position_id')->after('speed')->references('id')->on('vehicle_positions');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
