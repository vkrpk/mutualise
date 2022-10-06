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
            $table->foreignId('user_id')->constrained("users");
            $table->foreignId('order_id')->constrained("orders");
            $table->string('password', 255)->nullable(false);
            $table->string('name', 16)->nullable(false);
            $table->timestamp('expire_at')->nullable(true)->comment('when the account expires.');
            $table->timestamp('termination')->nullable(true)->comment('date to terminate account');
            $table->bigInteger('quota')->nullable(true)->comment('user\'s disk quota');
            $table->bigInteger('lastquotacheck')->nullable(true)->comment('user\'s disk usage at last check');
            $table->timestamp('quotacheckdatetime')->nullable(true)->comment('when last quota check was done');
            $table->integer('alert_quota_threshold')->nullable(true)->default(90)->comment('send mail if quota exceeds this threshold (percentage)');
            $table->bigInteger('nb_files')->nullable(true)->comment('nb files at last check');
            $table->bigInteger('nb_dirs')->nullable(true)->comment('nb directories: at last check');
            $table->string('level', 2)->nullable(true)->comment('security level for storage');
            $table->integer('expire_remind')->nullable(true)->default(-1)->comment('remind sent at 31, 15, 7, 3 et 0 days before account expires');
            $table->decimal('paid', 10, 2)->nullable(true)->default(0)->comment('amount paid for this access');
            $table->string('status', 50)->nullable(true)->default('')->comment('action status');
            $table->timestamp('unblock_until')->nullable(true)->comment('delay for cleaning access');
            $table->text('lasterror')->nullable(true)->default('')->comment('last system script error');
            $table->smallInteger('notifybackup')->nullable(true)->default(1)->comment('sendmail after backup ?');
            $table->timestamps();
            $table->softDeletes();
            $table->unique('name');
            // $table->string('payee', 255)->nullable(true)->comment('payee associated with member\'s order');
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
