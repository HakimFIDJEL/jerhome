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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('primary_color')->nullable();
            $table->string('secondary_color')->nullable();
            $table->string('background_color')->nullable();
            $table->string('font_color')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('primary_color');
            $table->dropColumn('secondary_color');
            $table->dropColumn('background_color');
            $table->dropColumn('font_color');
        });
    }
};
