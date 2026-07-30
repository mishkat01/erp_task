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
        Schema::create('requisition_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requisition_id')->nullable()->index()->constrained('purchase_requisitions')->cascadeOnDelete();
            $table->foreignId('product_id')->nullable()->index()->constrained('products')->restrictOnDelete();
            $table->integer('quantity');
            $table->string('remarks')->nullable();
            $table->timestamps();

            $table->unique(['requisition_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisition_items');
    }
};
