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
        Schema::create('agreement', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('dateSuscription');
            $table->date('dateStar');
            $table->string('fullText');
            $table->foreignId('idIssue')->constrained('issuess')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agreement');
    }
};
