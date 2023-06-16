<?php

namespace Database\Seeders;

use App\Models\PortageDimenssion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortageDimenssionSeeder extends Seeder
{

    public function run(): void
    {
        PortageDimenssion::create([
            'title' => 'البعد الحركي' ,

        ]);
        PortageDimenssion::create([
            'title' => 'البعد الاجتماعي' ,

        ]);
        PortageDimenssion::create([
            'title' => 'بعد العناية الذاتية' ,

        ]);
        PortageDimenssion::create([
            'title' => 'البعد الاتصالي' ,

        ]);
        PortageDimenssion::create([
            'title' => 'البعد المعرفي' ,

        ]);
    }
}
