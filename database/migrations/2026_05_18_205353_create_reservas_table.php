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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hospede_id'); // Sem o ->constrained()
            $table->string('nome_completo', 255);
            $table->string('telefone', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('cpf_passport', 50)->nullable();
            $table->integer('quantidade_total_pessoas')->default(1);
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->string('status', 20)->default('pendente');
            $table->decimal('valor_total', 10, 2)->nullable();
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
