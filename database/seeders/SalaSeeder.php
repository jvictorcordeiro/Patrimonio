<?php

namespace Database\Seeders;

use App\Models\Sala;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $salas = Sala::factory(10)->create();
        
        foreach($salas as $sala){
            $sala->unidades()->attach(2);
        }
    }
}
