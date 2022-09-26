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
            $table->string('identifier')->nullable(false);
            $table->string('address')->nullable(false);
            $table->string('address_complement')->nullable(true);
            $table->string('postal_code')->nullable(false);
            $table->string('city')->nullable(false);
            $table->string('state')->nullable(true);
            $table->string('country')->nullable(true);
            $table->string('phone_number')->nullable(true);
            $table->foreignId('user_id')->nullable()->constrained("users");
            $table->timestamps();            
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
