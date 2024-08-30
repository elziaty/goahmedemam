<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_transfer_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_transfer_id')->constrained('stock_transfers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('business_id')->constrained('businesses')->onUpdate('cascade')->onDelete('cascade'); 
            $table->foreignId('vari_loc_det_id')->constrained('variation_location_details')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('to_vari_loc_det_id')->constrained('variation_location_details')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('quantity',22,2)->default(0);
            $table->decimal('unit_price',22,2)->default(0);
            $table->decimal('total_unit_price',22,2)->default(0);  
            $table->timestamps(); 
            
            $table->index('stock_transfer_id'); 
            $table->index('business_id');
            $table->index('vari_loc_det_id');
            $table->index('to_vari_loc_det_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_transfer_items');
    }
};
