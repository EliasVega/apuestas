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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            $table->string('name', 45);
            $table->string('code', 4);
            $table->string('nit', 20)->unique();
            $table->string('dv', 1);
            $table->string('address', 100);
            $table->string('phone', 12);
            $table->string('email', 50)->unique();
            $table->string('imageName', 20);
            $table->string('logo', 255)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            //$table->enum('cash_register', ['active', 'inactive'])->default('active');

            $table->foreignId('department_id')->constrained()->onUpdate('cascade')->ondelete('cascade');
            $table->foreignId('municipality_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('companies');
    }
};
