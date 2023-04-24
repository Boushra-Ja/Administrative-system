<?php

namespace Database\Seeders;

use App\Models\PersonalChoice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonalChoiceSeeder extends Seeder
{

    public function run(): void
    {
        PersonalChoice::create([

            'personal_id' => 24,
            'choice' => 'نعم'

        ]);
        PersonalChoice::create([

            'personal_id' => 24,
            'choice' => 'لا'

        ]);

        PersonalChoice::create([

            'personal_id' => 26,
            'choice' => 'نعم'

        ]);
        PersonalChoice::create([

            'personal_id' => 26,
            'choice' => 'لا'

        ]);
    }
}
