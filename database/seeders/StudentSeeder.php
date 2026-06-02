<?php

namespace Database\Seeders;

use App\Models\Blood;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->delete();
        $students = new Student();
        $students->name = ['ar' => 'احمد ابراهيم', 'en' => 'Ahmed Ibrahim'];
        $students->email = 'Ahmed_Ibrahim@yahoo.com';
        $students->password = Hash::make('12345678');
        $students->gender_id  = 1;
        $students->nationality_id  = Nationality::all()->unique()->random()->id;
        $students->blood_id  =Blood::all()->unique()->random()->id;
        $students->date_birth = date('1995-01-01');
        $students->grade_id  = Grade::all()->unique()->random()->id;
        $students->classroom_id  =Classroom::all()->unique()->random()->id;
        $students->section_id  = Section::all()->unique()->random()->id;
        $students->parent_id  = MyParent::all()->unique()->random()->id;
        $students->academic_year ='2026';
        $students->save();
    }
}
