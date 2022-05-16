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
            $table->engine = 'InnoDB';
            $table->id();
            $table->enum('employee', ['emer riascos','cristian de la rua','joseph aveiro','flavia dos santos', 'christina jackson','pedro fernadez']);
            $table->enum('coffe_store', ['argentina -  rosario de santa fe', 'chile - santiago de chile', 'colombia - medellín', 'sao paulo - Rua Libero Badaró', 'españa - madird', 'marruecos - maroc', 'méxico - CDMX', 'perú - lima', 'portugal - lisboa', 'usa - miami']);
            $table->enum('payment_method', ['credit card','debit card', 'cash payment']);
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
