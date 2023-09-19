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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->nullable()->constrained('subjects')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('assigned_by_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->dateTime('assigned_on');
            $table->dateTime('started_on');
            $table->boolean('question')->default(false);
            $table->boolean('favorite')->default(false);
            $table->string('code_list')->nullable();
            $table->text('user_notes')->nullable();
            $table->integer('opinion')->default(0);
            $table->dateTime('completed_on');
            $table->foreignId('reviewed_by')->nullable()->constrained('users');
            $table->dateTime('reviewed_on')->nullable();
            $table->text('reviewed_opinion')->nullable();
            $table->boolean('inactive')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
