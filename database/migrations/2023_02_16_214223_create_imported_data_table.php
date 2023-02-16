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
            $table->string('gender');
            $table->string('name_set');
            $table->string('title');
            $table->string('given_name');
            $table->string('middle_initial');
            $table->string('surname');
            $table->string('streetaddress');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->string('country');
            $table->string('email_address');
            $table->string('password');
            $table->string('username');
            $table->string('browser_user_agent');
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
