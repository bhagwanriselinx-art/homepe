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

            // Pricing
            $table->decimal('expected_price',15,2)->nullable();
            $table->decimal('price_per_unit',15,2)->nullable();
            $table->boolean('tax_excluded')->default(0);
            $table->boolean('tax_included')->default(0);
            $table->boolean('price_negotiable')->default(0);

            // Maintenance
            $table->string('maintenance_type')->nullable();
            $table->decimal('maintenance_charge',10,2)->nullable();

            // Brokerage
            $table->boolean('brokerage_required')->default(0);
            $table->string('brokerage_type')->nullable();
            $table->decimal('brokerage_amount',10,2)->nullable();

            // Preleased
            $table->boolean('is_preleased')->default(0);
            $table->decimal('current_rent',12,2)->nullable();
            $table->string('lease_tenure')->nullable();
            $table->decimal('annual_rent_increase',5,2)->nullable();
            $table->string('leased_to')->nullable();

            // Description
            $table->text('pricing_description')->nullable();
        });
    }

    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn([
                'expected_price','price_per_unit',
                'tax_excluded','tax_included','price_negotiable',
                'maintenance_type','maintenance_charge',
                'brokerage_required','brokerage_type','brokerage_amount',
                'is_preleased','current_rent','lease_tenure',
                'annual_rent_increase','leased_to',
                'pricing_description'
            ]);
        });
    }
};
