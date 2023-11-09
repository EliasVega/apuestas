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
        Schema::create('lottery_plays', function (Blueprint $table) {
            $table->id();

            $table->enum('type', ['pleno', 'combinado'])->default('pleno');
            $table->string('number', 4);
            $table->integer('value');

            $table->foreignId('lottery_id')->constrained();
            $table->foreignId('play_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lottery_plays');
    }
};
