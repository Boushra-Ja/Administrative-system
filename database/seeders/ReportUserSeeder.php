<?php

namespace Database\Seeders;

use App\Models\Diseases;
use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportUserSeeder extends Seeder
{

    public function run(): void
    {
        $request = Level::orderByDesc('id')->get();

        foreach ($request as $leve) {
            DB::table('report_users')->insert([
                'number' => '0',
                'level_id' => $leve->id,
                'year' => date('Y')
            ]);
        }}
}
