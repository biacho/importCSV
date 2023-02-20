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
        Schema::create('imported_data', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->string('gender')->nullable();
            $table->string('name_set')->nullable();
            $table->string('title')->nullable();
            $table->string('given_name');
            $table->string('middle_initial')->nullable();
            $table->string('surname');
            $table->string('street_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country')->nullable();
            $table->string('email_address')->nullable();
            $table->string('password')->nullable();
            $table->string('username')->nullable();
            $table->string('browser_user_agent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imported_data');
    }
};
