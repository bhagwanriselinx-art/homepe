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
        Schema::create('sub_property_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id'); // categories table id
            $table->string('name'); // Sub Type Name
            $table->string('slug')->unique();
            $table->integer('status')->default(1);
            $table->timestamps();

            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sub_property_types');
    }
};
