<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('name')->after('user_id');
            $table->string('phone')->after('name');
            $table->text('address')->after('phone');
            $table->string('payment_method')->after('address');
            $table->string('receipt')->nullable()->after('payment_method');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['name', 'phone', 'address', 'payment_method', 'receipt']);
        });
    }
};
