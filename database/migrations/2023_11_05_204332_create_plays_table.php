<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plays', function (Blueprint $table) {
            $table->id();

            $table->decimal('total',10,2);
            $table->decimal('pay',10,2);
            $table->date('date');
            $table->enum('payment_form', ['contado', 'credito'])->default('contado');
            $table->enum('payment_method', ['efectivo', 'nequi'] )->default('efectivo');

            $table->foreignId('lottery_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plays');
    }
};
