<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
      public function up()
    {
        Schema::table('properties', function (Blueprint $table) {

            $table->json('club_features')->nullable();
            $table->json('proximity_highlights')->nullable();
            $table->string('floor_details')->nullable();
            $table->string('ownership_type')->nullable();
            $table->boolean('is_previously_used')->default(0);
            $table->json('location_advantages')->nullable();

        });
    }

    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {

            $table->dropColumn([
                'club_features',
                'proximity_highlights',
                'floor_details',
                'ownership_type',
                'is_previously_used',
                'location_advantages',
            ]);

        });
    }
};
