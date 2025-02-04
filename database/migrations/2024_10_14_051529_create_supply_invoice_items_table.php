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
        Schema::create('supply_invoice_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supply_invoice_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->decimal('cost_price', 10, 2);
            $table->enum('status', ['composed', 'stocked', 'canceled'])->default('composed');
            $table->timestamps();
        
            $table->foreign('supply_invoice_id')->references('id')->on('supply_invoices')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supply_invoice_items');
    }
};
