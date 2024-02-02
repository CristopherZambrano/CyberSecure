<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('type_persons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('type_persons')->insert([
            ['name' => 'user'],
            ['name' => 'Admin'] 
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_persons');
    }
};
