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
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id('withdrawal_id');
            $table->string('name')->nullable();
            $table->string('member_id')->nullable();
            $table->string('admin_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('account_num')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('user_code')->nullable();
            $table->string('approver_id')->nullable();
            $table->string('approver_user_code')->nullable();
            $table->integer('status')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};


