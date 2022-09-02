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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable(false);
            $table->string('label')->nullable(false);
            $table->string('first_name')->nullable(true);
            $table->string('last_name')->nullable(true);
            $table->string('organization')->nullable(true);
            $table->string('address1')->nullable(false);
            $table->string('address2')->nullable(true);
            $table->string('postal_code')->nullable(false);
            $table->string('city')->nullable(false);
            $table->string('state')->nullable(true);
            $table->string('country')->nullable(true);
            $table->string('phone_number')->nullable(true);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
