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
        Schema::create('cash_registers', function (Blueprint $table) {
            $table->id();

            $table->decimal('cash_initial',20,2);//inicio efectivo
            $table->decimal('in_cash',20,2);//ingresos de efectivo sin comprobante
            $table->decimal('out_cash',20,2);//total salidas de efectivo entregas de caja
            $table->decimal('in_total',20,2);//total ingresos pagos en general
            $table->decimal('out_total',20,2);//total de egresos pagos en general
            $table->decimal('nequi',20,2);
            $table->decimal('credito',20,2);
            $table->decimal('cash_in_total',20,2);//total entradas efectivo
            $table->decimal('cash_out_total',20,2);//total salidas efectivo
            $table->decimal('value_play_total', 20,2);//valor de juego real
            $table->decimal('play',20,2);//ventas por juegos

            $table->enum('status', ['open', 'close'])->default('open');
            $table->foreignId('user_id')->constrained()->onUpdate('cascade');

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
        Schema::dropIfExists('cash_registers');
    }
};
