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
        Schema::create('batches', function (Blueprint $table) {
            $table->id();

            $table->string('name', 191);

            $table->string('mts_north', 191);
            $table->string('mts_south', 191);
            $table->string('mts_est', 191);
            $table->string('mts_west', 191);
            
            $table->string('adjoins_north', 191);
            $table->string('adjoins_south', 191);
            $table->string('adjoins_est', 191);
            $table->string('adjoins_west', 191);

            $table->string('amount_owed', 191);
            $table->string('amount', 191);
            $table->tinyInteger('status')->default(1);

            $table->foreignId('project_id')
                ->nullable()
                ->constrained('projects');
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users');

            $table->foreignId('seller_id')
                ->nullable()
                ->constrained('users');

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
        Schema::dropIfExists('batches');
    }
};
