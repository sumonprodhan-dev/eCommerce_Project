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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->float('amount');
            $table->float('invoice_number')->nullable();
            $table->string('payment_method');
            $table->string('tran_id')->nullable();
            $table->string('currency')->nullable();
            $table->string('bank_tran_id')->nullable();
            $table->text('payment_type')->nullable();
            $table->enum('payment_status', ['Pending', 'Successful', 'Processing', 'Complete', 'Failed', 'Canceled'])->default('Pending');
            $table->text('order_note')->nullable();
            $table->text('shipping_address')->nullable();
            $table->enum('status', ['pending', 'approved', 'processing', 'shipped', 'delivered', 'declined'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
