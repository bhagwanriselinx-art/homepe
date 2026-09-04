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

        $table->string('category_type')->nullable()->after('purpose');
        $table->unsignedBigInteger('sub_property_type_id')->nullable()->after('property_type_id');

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
