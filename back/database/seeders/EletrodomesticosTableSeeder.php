<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Eletrodomestico;

class EletrodomesticosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Verifica se a tabela "eletrodomesticos" está vazia
         if (Eletrodomestico::count() === 0) {
            // Dados de exemplo para os eletrodomésticos
            $eletrodomesticos = [
                [
                    'nome' => 'Geladeira Frost Free',
                    'descricao' => 'Este produto é totalmente versátil. Tudo para ser personalizado para comportar o que você preferir.',
                    'tensao' => '220v',
                    'marca_id' => 1,
                ],
                [
                    'nome' => 'Máquina de Lavar Roupas',
                    'descricao' => 'Lava suas roupas com eficiência e economia de água e energia.',
                    'tensao' => '127v',
                    'marca_id' => 2,
                ],
                [
                    'nome' => 'Fogão 4 Bocas',
                    'descricao' => 'Este produto é totalmente versátil. Tudo para ser personalizado para comportar o que você preferir.',
                    'tensao' => '220v',
                    'marca_id' => 3,
                ],
                [
                    'nome' => 'Microondas',
                    'descricao' => 'Este produto é totalmente versátil. Tudo para ser personalizado para comportar o que você preferir.',
                    'tensao' => '127v',
                    'marca_id' => 4,
                ],
                [
                    'nome' => 'Lava Louças',
                    'descricao' => 'Este produto é totalmente versátil. Tudo para ser personalizado para comportar o que você preferir.',
                    'tensao' => '220v',
                    'marca_id' => 5,
                ],
                // Adicione mais registros de exemplo se necessário
            ];
            foreach ($eletrodomesticos as $eletrodomestico) {
                Eletrodomestico::create($eletrodomestico);
            }
         }
    }
}
