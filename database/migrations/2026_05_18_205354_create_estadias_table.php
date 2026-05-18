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
        Schema::create('estadias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reserva_id'); // Apenas a coluna inteira
            $table->unsignedBigInteger('quarto_id');  // Apenas a coluna inteira
            $table->dateTime('data_checkin')->nullable();
            $table->dateTime('data_checkout')->nullable();
            $table->string('status', 20)->default('ativa');
            $table->decimal('valor_estadia', 10, 2)->nullable();
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estadias');
    }
};
