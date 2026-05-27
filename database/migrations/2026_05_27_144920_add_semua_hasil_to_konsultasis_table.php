<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('konsultasis', function (Blueprint $table) {
            $table->json('semua_hasil')->nullable()->after('cf_akhir');
        });
    }

    public function down(): void
    {
        Schema::table('konsultasis', function (Blueprint $table) {
            $table->dropColumn('semua_hasil');
        });
    }
};