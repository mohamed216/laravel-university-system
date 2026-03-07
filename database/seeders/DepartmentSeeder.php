<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        // First create faculties
        $faculties = [
            ['id' => 1, 'name' => 'كلية الطب', 'name_en' => 'Faculty of Medicine', 'code' => 'MED'],
            ['id' => 2, 'name' => 'كلية الهندسة', 'name_en' => 'Faculty of Engineering', 'code' => 'ENG'],
            ['id' => 3, 'name' => 'كلية علوم الحاسب', 'name_en' => 'Faculty of Computer Science', 'code' => 'CS'],
            ['id' => 4, 'name' => 'كلية إدارة الأعمال', 'name_en' => 'Faculty of Business Administration', 'code' => 'BUS'],
            ['id' => 5, 'name' => 'كلية العلوم', 'name_en' => 'Faculty of Science', 'code' => 'SCI'],
        ];

        foreach ($faculties as $faculty) {
            DB::table('faculties')->insert(array_merge($faculty, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Then create departments
        $departments = [
            // Medicine
            ['name' => 'قسم الطب البشري', 'name_en' => 'Department of Human Medicine', 'code' => 'MED001', 'faculty_id' => 1],
            ['name' => 'قسم طب الأسنان', 'name_en' => 'Department of Dentistry', 'code' => 'MED002', 'faculty_id' => 1],
            ['name' => 'قسم الصيدلة', 'name_en' => 'Department of Pharmacy', 'code' => 'MED003', 'faculty_id' => 1],
            
            // Engineering
            ['name' => 'قسم الهندسة المدنية', 'name_en' => 'Department of Civil Engineering', 'code' => 'ENG001', 'faculty_id' => 2],
            ['name' => 'قسم الهندسة الكهربائية', 'name_en' => 'Department of Electrical Engineering', 'code' => 'ENG002', 'faculty_id' => 2],
            ['name' => 'قسم الهندسة الميكانيكية', 'name_en' => 'Department of Mechanical Engineering', 'code' => 'ENG003', 'faculty_id' => 2],
            
            // Computer Science
            ['name' => 'قسم علوم الحاسب', 'name_en' => 'Department of Computer Science', 'code' => 'CS001', 'faculty_id' => 3],
            ['name' => 'قسم نظم المعلومات', 'name_en' => 'Department of Information Systems', 'code' => 'CS002', 'faculty_id' => 3],
            ['name' => 'قسم هندسة البرمجيات', 'name_en' => 'Department of Software Engineering', 'code' => 'CS003', 'faculty_id' => 3],
            
            // Business
            ['name' => 'قسم إدارة الأعمال', 'name_en' => 'Department of Business Administration', 'code' => 'BUS001', 'faculty_id' => 4],
            ['name' => 'قسم المحاسبة', 'name_en' => 'Department of Accounting', 'code' => 'BUS002', 'faculty_id' => 4],
            ['name' => 'قسم الاقتصاد', 'name_en' => 'Department of Economics', 'code' => 'BUS003', 'faculty_id' => 4],
            
            // Science
            ['name' => 'قسم الفيزياء', 'name_en' => 'Department of Physics', 'code' => 'SCI001', 'faculty_id' => 5],
            ['name' => 'قسم الكيمياء', 'name_en' => 'Department of Chemistry', 'code' => 'SCI002', 'faculty_id' => 5],
            ['name' => 'قسم الرياضيات', 'name_en' => 'Department of Mathematics', 'code' => 'SCI003', 'faculty_id' => 5],
        ];

        foreach ($departments as $department) {
            DB::table('departments')->insert(array_merge($department, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
