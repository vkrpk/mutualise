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
        Schema::create('member_accesses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained("orders");
            $table->string('password', 255)->nullable(true);
            $table->enum('member_access', ['Pydio', 'Seafile', 'Nextcloud', 'All'])->nullable(false);
            // $table->string('name', 16)->nullable(false);
            $table->string('name')->nullable(false);
            $table->integer('diskspace')->nullable(false);
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
        Schema::dropIfExists('member_accesses');
    }
};
