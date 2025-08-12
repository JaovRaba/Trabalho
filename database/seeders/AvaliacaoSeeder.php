<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AvaliacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('avaliacoes')->insert([
            'nota' => 5,
            'status' => 'Visto',
            'filme_id' => 1,
            'user_id' => 2,
        ]);
    }
}
