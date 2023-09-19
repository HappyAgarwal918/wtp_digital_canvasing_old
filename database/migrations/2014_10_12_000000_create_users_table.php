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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_initial')->nullable();
            $table->string('last_name');
            $table->date('birthday');
            $table->string('gender');
            $table->bigInteger('phone')->unique();
            $table->string('email')->unique();
            $table->integer('last_4_ssn');
            $table->text('street_address');
            $table->string('city');
            $table->string('state');
            $table->integer('zipcode');
            $table->integer('voter_id');
            $table->foreignId('manager_id')->nullable()->constrained('users');
            $table->text('notes')->nullable();
            $table->foreignId('approved_by_id')->nullable()->constrained('users');
            $table->string('username')->unique();
            $table->string('password');
            $table->longText('user_label')->nullable();
            // $table->integer('user_label');
            $table->boolean('inactive')->default(false);
            // $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
