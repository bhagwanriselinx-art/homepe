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
    Schema::create('child_sub_property_types', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('sub_property_type_id');
        $table->string('name');
        $table->string('slug')->nullable();
        $table->boolean('status')->default(1);
        $table->timestamps();

        $table->foreign('sub_property_type_id')
              ->references('id')
              ->on('sub_property_types')
              ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_sub_property_types');
    }
};
