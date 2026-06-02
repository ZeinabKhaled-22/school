<?php

namespace Database\Seeders;

use App\Models\Blood;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Religion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('parents')->delete();
            $my_parents = new MyParent();
            $my_parents->email = 'parent@yahoo.com';
            $my_parents->password = Hash::make('12345678');
            $my_parents->father_name = ['en' => 'emad', 'ar' => 'عماد محمد'];
            $my_parents->father_national_id = '1234567810';
            $my_parents->father_passport_id = '1234567810';
            $my_parents->father_phone = '1234567810';
            $my_parents->father_job = ['en' => 'programmer', 'ar' => 'مبرمج'];
            $my_parents->father_nationality  = Nationality::all()->unique()->random()->id;
            $my_parents->father_blood  =Blood::all()->unique()->random()->id;
            $my_parents->father_religion  = Religion::all()->unique()->random()->id;
            $my_parents->father_address ='القاهرة';
            $my_parents->mother_name = ['en' => 'SS', 'ar' => 'سس'];
            $my_parents->mother_national_id = '1234567810';
            $my_parents->mother_passport_id = '1234567810';
            $my_parents->mother_phone = '1234567810';
            $my_parents->mother_job = ['en' => 'Teacher', 'ar' => 'معلمة'];
            $my_parents->mother_nationality  = Nationality::all()->unique()->random()->id;
            $my_parents->mother_blood  =Blood::all()->unique()->random()->id;
            $my_parents->mother_religion  = Religion::all()->unique()->random()->id;
            $my_parents->mother_address ='القاهرة';
            $my_parents->save();
    }
}
