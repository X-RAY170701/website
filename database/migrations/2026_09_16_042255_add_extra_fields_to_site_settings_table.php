<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('stat_customers')->nullable()->after('footer_text');
            $table->string('stat_products')->nullable()->after('stat_customers');
            $table->string('stat_experience')->nullable()->after('stat_products');
            $table->string('stat_satisfaction')->nullable()->after('stat_experience');
            $table->string('meta_title')->nullable()->after('stat_satisfaction');
            $table->string('meta_description')->nullable()->after('meta_title');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'stat_customers', 'stat_products', 'stat_experience',
                'stat_satisfaction', 'meta_title', 'meta_description',
            ]);
        });
    }
};
