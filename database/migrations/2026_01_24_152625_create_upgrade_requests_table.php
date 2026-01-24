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
        Schema::create('upgrade_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('from_category_id')->constrained('user_categories')->onDelete('cascade');
            $table->foreignId('to_category_id')->constrained('user_categories')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('payment_url')->nullable();
            $table->string('payment_screenshot')->nullable();
            $table->enum('status', ['pending_payment', 'pending_approval', 'approved', 'rejected'])->default('pending_payment');
            $table->text('admin_notes')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upgrade_requests');
    }
};
