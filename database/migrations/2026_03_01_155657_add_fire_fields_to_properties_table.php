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

    $table->json('fire_safety')->nullable();
    $table->boolean('cctv_available')->nullable();
    $table->integer('no_of_staircases')->nullable();
    $table->boolean('noc_certified')->nullable();
    $table->boolean('occupancy_certificate')->nullable();
    $table->string('previously_used_for')->nullable();

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            //
        });
    }
};
