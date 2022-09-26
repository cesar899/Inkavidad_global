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

            $table->string('bank_name', 191);
            $table->string('ref_number', 191);
            $table->string('payment_proof', 191);
            $table->tinyInteger('status');

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users');

            $table->foreignId('seller_id')
                ->nullable()
                ->constrained('users');

            $table->foreignId('batch_id')
                ->nullable()
                ->constrained('batchs');

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
        Schema::dropIfExists('orders');
    }
};
