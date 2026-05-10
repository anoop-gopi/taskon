<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mock_test_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mock_test_id')->constrained('mock_tests')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedSmallInteger('score')->default(0);
            $table->unsignedSmallInteger('total_questions');
            $table->timestamp('completed_at');
            $table->timestamps();

            $table->index(['user_id', 'mock_test_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mock_test_attempts');
    }
};
