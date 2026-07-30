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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('po_no')->nullable()->unique();
            $table->foreignId('requisition_id')->nullable()->unique()->constrained('purchase_requisitions')->restrictOnDelete();
            $table->foreignId('supplier_id')->nullable()->index()->constrained('suppliers')->restrictOnDelete();
            $table->date('order_date');
            $table->foreignId('created_by')->nullable()->constrained('employees')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
