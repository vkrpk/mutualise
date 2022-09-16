<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users')->nullable(false);
            $table->foreignId('adresses')->nullable(true);
            $table->string('order_number')->nullable(false);
            $table->enum('formule', ['basique', 'standard', 'entreprise', 'dédié'])->nullable(false);
            $table->enum('payment_period', ['M', 'Y'])->nullable(true);
            $table->string('payee', 50)->nullable(false); // ??
            $table->decimal('total_paid')->nullable(true)->default(0);
            $table->boolean('subscription')->nullable(true)->default(false);
            $table->decimal('subscription_paid')->nullable(true)->default(0);
            $table->bigInteger('diskspace')->nullable(false)->default(10);
            $table->timestamp('expire')->nullable(true);
            $table->jsonb('options')->nullable(true);
            $table->decimal('diskspace_paid')->nullable(true)->default(0);
            $table->decimal('monthly_payment')->nullable(true)->default(0);
            $table->text('comment')->nullable(true);
            $table->text('payment_mode')->nullable(true);
            $table->string('status')->nullable(false)->default('cart');
            $table->decimal('coupon_value')->nullable(true);
            $table->string('coupon_code', 10)->nullable(true);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
