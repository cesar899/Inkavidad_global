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
            $table->foreignId('batch_id')
                  ->nullable()
                  ->unsigned()
                  ->constrained('batches')
                  ->cascadeOnUpdate()
                  ->nullOnDelete();
            $table->foreignId('seller_id')
                  ->nullable()
                  ->unsigned()
                  ->constrained('users')
                  ->cascadeOnUpdate()
                  ->nullOnDelete();
            $table->foreignId('user_id')
                  ->nullable()
                  ->unsigned()
                  ->constrained('users')
                  ->cascadeOnUpdate()
                  ->nullOnDelete();
            $table->tinyInteger('status');
            $table->string('amount', 191);
            $table->string('amount_paid', 191);
            $table->string('dues', 191);
            $table->timestamp('next_pay', $precision = 0)->nullable()->dafaul(null);
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
