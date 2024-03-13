<?php

namespace Database\Seeders;

use App\Models\JenisKirim;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KurirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisKirim::create([
            'nama' => 'jne', 
            'created_by' => 1
        ]);
        JenisKirim::create([
            'nama' => 'pos', 
            'created_by' => 1
        ]);
        JenisKirim::create([
            'nama' => 'tike', 
            'created_by' => 1
        ]);
    }
}
