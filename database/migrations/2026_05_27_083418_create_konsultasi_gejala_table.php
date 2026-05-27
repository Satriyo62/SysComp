<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('konsultasi_gejala', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konsultasi_id')->constrained()->onDelete('cascade');
            $table->foreignId('gejala_id')->constrained()->onDelete('cascade');
            $table->decimal('cf_user', 5, 2); // Certainty Factor dari user
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konsultasi_gejala');
    }
};