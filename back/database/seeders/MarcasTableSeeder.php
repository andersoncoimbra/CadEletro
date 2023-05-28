<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Marca;

class MarcasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Verifica se a tabela está vazia
        if(Marca::count() === 0) {
            $marcas = [          
                ['id'=> 1, 'nome' => 'Eletrolux'],
                ['id'=> 2, 'nome' => 'Brastemp'],
                ['id'=> 3, 'nome' => 'Fischer'],
                ['id'=> 4, 'nome' => 'Samsung'],
                ['id'=> 5, 'nome'=> 'LG']
            ];
            foreach($marcas as $marca) {
                Marca::create($marca);
            }
        }
    }
}
