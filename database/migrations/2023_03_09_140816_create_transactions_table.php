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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->constrained();
            $table->unsignedBigInteger('from_account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->unsignedBigInteger('to_account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('transaction_type', 50);
            $table->decimal('last_current_balance', 10, 2);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
