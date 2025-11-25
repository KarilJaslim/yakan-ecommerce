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
        Schema::table('custom_orders', function (Blueprint $table) {
            // Contact Information
            $table->string('phone')->nullable()->after('quantity');
            $table->string('email')->nullable()->after('phone');
            $table->text('delivery_address')->nullable()->after('email');
            
            // Product Details
            $table->string('product_type')->nullable()->after('product_id');
            $table->string('dimensions')->nullable()->after('specifications');
            $table->string('preferred_colors')->nullable()->after('dimensions');
            
            // Color Customization
            $table->string('primary_color')->default('#ef4444')->after('preferred_colors');
            $table->string('secondary_color')->default('#3b82f6')->after('primary_color');
            $table->string('accent_color')->default('#10b981')->after('secondary_color');
            
            // Budget & Timeline
            $table->string('budget_range')->nullable()->after('quantity');
            $table->date('expected_date')->nullable()->after('budget_range');
            
            // Additional Details
            $table->text('additional_notes')->nullable()->after('specifications');
            $table->decimal('estimated_price', 10, 2)->nullable()->after('payment_status');
            $table->decimal('final_price', 10, 2)->nullable()->after('estimated_price');
            
            // Admin fields
            $table->text('admin_notes')->nullable()->after('final_price');
            $table->timestamp('approved_at')->nullable()->after('admin_notes');
            $table->timestamp('rejected_at')->nullable()->after('approved_at');
            $table->string('rejection_reason')->nullable()->after('rejected_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_orders', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'email',
                'delivery_address',
                'product_type',
                'dimensions',
                'preferred_colors',
                'primary_color',
                'secondary_color',
                'accent_color',
                'budget_range',
                'expected_date',
                'additional_notes',
                'estimated_price',
                'final_price',
                'admin_notes',
                'approved_at',
                'rejected_at',
                'rejection_reason'
            ]);
        });
    }
};