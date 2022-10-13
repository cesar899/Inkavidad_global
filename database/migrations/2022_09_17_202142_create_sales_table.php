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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users');

            $table->foreignId('seller_id')
                ->nullable()
                ->constrained('users');

            $table->foreignId('batch_id')
                ->nullable()
                ->constrained('batches');
            $table->tinyInteger('status')->default(0)->comment('0 - Reserved, 1 - Partially Paid, 2 - Paid');
            $table->double('amount', 8, 2)->default(0);
            $table->double('amount_paid', 8, 2)->default(0);
            $table->string('cuote_account')->nullable()->comment('cantidad de cuotas de la venta');
            $table->string('cuote_paid')->nullable()->comment('cuotas pagadas');
            $table->string('paid_comming')->comment('dias de lapso para el proximo pago');
            $table->date('day_payment')->nullable()->comment('fecha del proximo pago');
            $table->double('dues', 191)->nullable();
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
        Schema::dropIfExists('sales');
    }
};
