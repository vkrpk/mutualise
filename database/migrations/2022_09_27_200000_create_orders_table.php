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
            $table->id(); // id de la session
            $table->string('payment_intent')->nullable(false);
            $table->foreignId('user_id')->constrained("users");
            $table->foreignId('order_address_id')->constrained("order_addresses"); // ! nouvelle teable
            $table->foreignId('formula_id')->constrained("formulas"); // dédié, et cie, autre table
            $table->foreignId('coupon_id')->nullable()->constrained('coupons'); // nouvelle table
            $table->bigInteger('diskspace')->default(10);
            $table->enum('mode', ['payment', 'subscription', 'free'])->nullable(true);
            $table->enum('member_access', ['Pydio', 'Seafile', 'Nextcloud', 'all'])->nullable(false);
            $table->dateTime('expire')->nullable(true);
            $table->decimal('total_paid')->default(0);
            $table->boolean('includes_adhesion')->default(false);
            $table->text('comment')->nullable(true);
            $table->string('payment_mode')->default('stripe');
            $table->enum('status', ['cancelled', 'complete', 'pending', 'expired'])->nullable(false)->default('pending');
            // $table->decimal('coupon_value')->nullable(true);
            // $table->string('coupon_code', 10)->nullable(true);

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
