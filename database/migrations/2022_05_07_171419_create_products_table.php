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
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name');
            $table->enum('reference', ['250ml', '500ml', '600ml','1l','1.5l', 'und[s]','libra[s]','kilo[s]']);
            $table->decimal('price', 8, 2);
            $table->enum('category', ['bebidas', 'panadería', 'pastelería', 'postres', 'tortas']);
            $table->bigInteger('stock');
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
        Schema::dropIfExists('products');
    }
};
