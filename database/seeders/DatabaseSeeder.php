<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\PortageDimenssion;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            TitelsSeeder::class ,
            MedicalQuestionSeeder::class ,
            MedicalChoiceSeeder::class ,
            EductionalQuestionSeeder::class,
            EductionalChoiceSeeder::class,
            PersonalQuestionSeeder::class,
            PersonalChoiceSeeder::class,
            UserSeeder::class,
            PortageDimenssionSeeder::class,
            DiseaseSeeder::class,
            ViewSeeder::class,
            InfectionSeeder::class,
            LevelSeeder::class,
            ReportUserSeeder::class,


        ]);
    }
}
