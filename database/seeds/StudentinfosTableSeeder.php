<?php

use App\StudentInfo;
use Illuminate\Database\Seeder;

class StudentinfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(StudentInfo::class, 1)->states('without_group')->create();
        factory(StudentInfo::class, 6)->states('science')->create();
        factory(StudentInfo::class, 6)->states('commerce')->create();
        factory(StudentInfo::class, 6)->states('arts')->create();
    }
}
