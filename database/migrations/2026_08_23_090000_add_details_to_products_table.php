<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->longText('long_description')->nullable()->after('description');
            $table->json('highlights')->nullable()->after('long_description');
            $table->json('style_guidance')->nullable()->after('highlights');
            $table->json('partnerships')->nullable()->after('style_guidance');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['long_description', 'highlights', 'style_guidance', 'partnerships']);
        });
    }
};
