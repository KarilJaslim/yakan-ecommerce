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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(0);
            $table->integer('min_stock_level')->default(5);
            $table->integer('max_stock_level')->default(100);
            $table->decimal('cost_price', 10, 2)->nullable();
            $table->decimal('selling_price', 10, 2)->nullable();
            $table->string('supplier')->nullable();
            $table->string('location')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('low_stock_alert')->default(false);
            $table->timestamp('last_restocked_at')->nullable();
            $table->timestamps();
            
            $table->index('product_id');
            $table->index('low_stock_alert');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
