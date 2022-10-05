<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable(true);
            $table->string('stripe_id')->nullable();
            $table->boolean('is_adherent')->default(false);
            $table->smallInteger('nb_free_account')->nullable(false)->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE users ADD CONSTRAINT nb_free_account_max_value CHECK (nb_free_account >= 0 AND nb_free_account <= 4)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};

