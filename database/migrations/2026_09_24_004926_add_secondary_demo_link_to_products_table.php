<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('external_link_label')->nullable()->after('external_link');
            $table->string('external_link_2')->nullable()->after('external_link_label');
            $table->string('external_link_2_label')->nullable()->after('external_link_2');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['external_link_label', 'external_link_2', 'external_link_2_label']);
        });
    }
};
