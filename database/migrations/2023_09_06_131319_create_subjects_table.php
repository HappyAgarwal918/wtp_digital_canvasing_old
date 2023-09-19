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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cohort_id')->nullable()->constrained('cohorts');
            $table->string('voter_number_state')->nullable();
            $table->integer('voter_number_count');
            $table->string('voter_status');
            $table->string('name_prefix');
            $table->string('first_name');
            $table->string('middle_initial')->nullable();
            $table->string('last_name');
            $table->year('year_of_birth');
            $table->text('full_address');
            $table->date('registration_date');
            $table->date('last_change_date');
            $table->integer('congressional_district');
            $table->integer('legislative_district');
            $table->integer('precinct_number');
            $table->string('precinct_name');
            $table->integer('house_number');
            $table->string('street_direction');
            $table->integer('street_name');
            $table->string('street_type');
            $table->string('street_suffix')->nullable();
            $table->string('city');
            $table->string('country');
            $table->string('state',2);
            $table->integer('zip_code');
            $table->integer('unit_number')->nullable();
            $table->string('field_01')->nullable();
            $table->string('field_02')->nullable();
            $table->string('field_03')->nullable();
            $table->string('field_04')->nullable();
            $table->string('field_05')->nullable();
            $table->string('field_06')->nullable();
            $table->string('field_07')->nullable();
            $table->string('field_08')->nullable();
            $table->string('field_09')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
