<?php

namespace Database\Seeders;

use App\Models\Diseases;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $request = Diseases::orderByDesc('id')->get();

        foreach ($request as $disease) {
            DB::table('views')->insert([
                'number' => '0' ,
                'diseases_id' => $disease->id,
                'year'=> date('Y')
            ]);
        }



//        $request=new Diseases();
//        $countOfRow = $request->count();
//
//        $i=1;
//        while ($i<=$countOfRow) {
//            DB::table('views')->insert([
//                'number' => '0' ,
//                'diseases_id'=>$i,
//                'year'=> date('Y')
//        ]);
//            $i++;
//        }
//
//
    }
}
