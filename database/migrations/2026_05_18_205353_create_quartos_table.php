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
        Schema::create('quartos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hospede_id')->nullable(); // Apenas a coluna, sem a restrição física de FK
            $table->string('numero', 10)->unique();
            $table->string('tipo', 50);
            $table->integer('capacidade');
            $table->decimal('preco_diaria', 10, 2);
            $table->text('descricao')->nullable();
            $table->string('status', 20)->default('disponivel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quartos');
    }
};
