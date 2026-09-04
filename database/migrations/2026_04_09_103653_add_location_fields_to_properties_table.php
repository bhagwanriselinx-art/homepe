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
        Schema::table('properties', function (Blueprint $table) {

            $table->string('building_name')->nullable()->after('address');
            $table->string('state')->nullable()->after('building_name');
            $table->string('city')->nullable()->after('state');

        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {

            $table->dropColumn(['building_name', 'state', 'city']);

        });
    }
};
