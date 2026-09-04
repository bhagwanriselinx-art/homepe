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
        $table->unsignedBigInteger('child_sub_property_type_id')->nullable();

        $table->foreign('child_sub_property_type_id')
              ->references('id')
              ->on('child_sub_property_types')
              ->onDelete('set null');
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
