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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('last_name');
            $table->string('email');
            $table->string('password');
            $table->foreignId('rol')
                  ->nullable()
                  ->unsigned()
                  ->constrained('roles')
                  ->cascadeOnUpdate()
                  ->nullOnDelete();
            $table->bigInteger('countrie_id')->nullable();
            $table->bigInteger('prefix_id')->nullable();
            $table->tinyInteger('type_dni')->nullable();
            $table->string('dni')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('remember_token')->nullable();
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
        Schema::dropIfExists('users');
    }
};
