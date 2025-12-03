<?php

use Illuminate\Database\Migrations\Migration;

// Migration disabled - table already exists
return new class extends Migration
{
    public function up(): void
    {
        // Table already exists - do nothing
    }

    public function down(): void
    {
        // Schema::dropIfExists('notifications');
    }
};
