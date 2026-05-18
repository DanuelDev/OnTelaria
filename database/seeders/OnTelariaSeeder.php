<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OnTelariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        // Quartos
        DB::table('quartos')->insert([
            ['numero' => '1', 'tipo' => 'suite', 'capacidade' => 3, 'preco_diaria' => 100.00],
            ['numero' => '2', 'tipo' => 'suite', 'capacidade' => 3, 'preco_diaria' => 100.00],
            ['numero' => '3', 'tipo' => 'luxotriplo', 'capacidade' => 4, 'preco_diaria' => 300.00],
            // ... adicione os outros quartos aqui no mesmo padrão
        ]);

        // Hóspede Chatonildo
        $hospedeId = DB::table('hospedes')->insertGetId([
            'nome' => 'Cliente Chatonildo',
            'email' => 'cliente@email.com',
            'telefone' => '19446584',
            'cpf' => '4554648385',
            'data_nascimento' => '2025-11-18',
            'endereco' => 'Rua Muito Engraçada, Santa Catarina, CEP: 4546486',
            'senha' => '$2a$10$G84fota5R8s5FIGVIjaDMuTg8f9uMZje9KZXbl1biqzLoIAkIzgKy'
        ]);

        // Funcionário
        DB::table('funcionarios')->insert([
            'nome' => 'Funcionário dos Santos',
            'email' => 'funcionario@email.com',
            'setor' => 'Registro',
            'cpf' => '654894256',
            'senha' => '$2y$10$/mN4DWqP8eEk0EHc3eQLJO94nZzVGkG0wSJKQF2V6P5keLcZ7Gvte'
        ]);

        // Reserva vinculada ao hóspede cadastrado acima
        DB::table('reservas')->insert([
            'hospede_id' => $hospedeId,
            'nome_completo' => 'Gabriel Souza Silva',
            'telefone' => '+55 11 99999-8888',
            'email' => 'gabriel.silva@email.com',
            'cpf_passport' => '123.456.789-00',
            'quantidade_total_pessoas' => 3,
            'data_inicio' => '2026-05-10',
            'data_fim' => '2026-05-15',
            'status' => 'confirmada',
            'valor_total' => 1250.00,
            'observacoes' => 'Hóspede solicitou andar alto e cama extra de solteiro.'
        ]);
    }
}
