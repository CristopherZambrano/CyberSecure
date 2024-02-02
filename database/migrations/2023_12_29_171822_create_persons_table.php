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
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastName');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('enterprise');
            $table->string('user');
            $table->string('password');
            $table->foreignId('type_user_id')->constrained('type_persons')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};
