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
        Schema::create('cohorts', function (Blueprint $table) {
            $table->id();
            $table->string('user_description');
            $table->integer('election_number');
            $table->text('user_instructions');
            $table->longText('technical_description');
            $table->string('field_name_01')->nullable();
            $table->string('field_name_02')->nullable();
            $table->string('field_name_03')->nullable();
            $table->string('field_name_04')->nullable();
            $table->string('field_name_05')->nullable();
            $table->string('field_name_06')->nullable();
            $table->string('field_name_07')->nullable();
            $table->string('field_name_08')->nullable();
            $table->string('field_name_09')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamp('created_on');
            $table->boolean('active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cohorts');
    }
};
