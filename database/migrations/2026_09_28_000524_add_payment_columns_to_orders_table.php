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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->after('payment_status');
            $table->string('midtrans_order_id')->nullable()->unique()->after('payment_method');
            $table->string('midtrans_transaction_id')->nullable()->after('midtrans_order_id');
            $table->string('snap_token')->nullable()->after('midtrans_transaction_id');
            $table->timestamp('paid_at')->nullable()->after('snap_token');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'payment_method',
                'midtrans_order_id',
                'midtrans_transaction_id',
                'snap_token',
                'paid_at',
            ]);
        });
    }
};
