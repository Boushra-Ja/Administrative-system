<?php

namespace Database\Seeders;

use App\Models\Diseases;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('diseases')->insert([
          'id'=>1,
          'name' => 'داون' ,
        ]);
        DB::table('diseases')->insert([
            'id'=>2,
            'name' => 'توريت' ,
        ]);
    }
}
