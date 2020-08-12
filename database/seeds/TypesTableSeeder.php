<?php

use Illuminate\Database\Seeder;
use App\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create([
            'id' => '1',
            'profile' => 'Morador'
        ]);
        Type::create([
            'id' => '2',
            'profile' => 'Visitante'
        ]);
        Type::create([
            'id' => '3',
            'profile' => 'Funcionário'
        ]);
    }
}
