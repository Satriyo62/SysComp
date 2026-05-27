<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kerusakan_id')->constrained()->onDelete('cascade');
            $table->foreignId('gejala_id')->constrained()->onDelete('cascade');
            $table->decimal('mb', 5, 2); // Measure of Belief
            $table->decimal('md', 5, 2); // Measure of Disbelief
            $table->timestamps();
            
            // Unique constraint
            $table->unique(['kerusakan_id', 'gejala_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rules');
    }
};