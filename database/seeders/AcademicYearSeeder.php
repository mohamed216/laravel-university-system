<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcademicYear;
use App\Models\Semester;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Academic Year 2024-2025
        $year2024 = AcademicYear::create([
            'name' => '2024-2025',
            'start_date' => '2024-09-01',
            'end_date' => '2025-06-30',
            'is_current' => false,
            'is_registration_open' => false,
        ]);

        Semester::create([
            'academic_year_id' => $year2024->id,
            'name' => 'Fall 2024',
            'start_date' => '2024-09-01',
            'end_date' => '2025-01-15',
            'is_current' => false,
            'order' => 1,
        ]);

        Semester::create([
            'academic_year_id' => $year2024->id,
            'name' => 'Spring 2025',
            'start_date' => '2025-01-16',
            'end_date' => '2025-06-30',
            'is_current' => false,
            'order' => 2,
        ]);

        // Academic Year 2025-2026
        $year2025 = AcademicYear::create([
            'name' => '2025-2026',
            'start_date' => '2025-09-01',
            'end_date' => '2026-06-30',
            'is_current' => true,
            'is_registration_open' => true,
        ]);

        Semester::create([
            'academic_year_id' => $year2025->id,
            'name' => 'Fall 2025',
            'start_date' => '2025-09-01',
            'end_date' => '2026-01-15',
            'is_current' => true,
            'order' => 1,
        ]);

        Semester::create([
            'academic_year_id' => $year2025->id,
            'name' => 'Spring 2026',
            'start_date' => '2026-01-16',
            'end_date' => '2026-06-30',
            'is_current' => false,
            'order' => 2,
        ]);

        // Academic Year 2026-2027 (Future)
        $year2026 = AcademicYear::create([
            'name' => '2026-2027',
            'start_date' => '2026-09-01',
            'end_date' => '2027-06-30',
            'is_current' => false,
            'is_registration_open' => false,
        ]);

        Semester::create([
            'academic_year_id' => $year2026->id,
            'name' => 'Fall 2026',
            'start_date' => '2026-09-01',
            'end_date' => '2027-01-15',
            'is_current' => false,
            'order' => 1,
        ]);

        Semester::create([
            'academic_year_id' => $year2026->id,
            'name' => 'Spring 2027',
            'start_date' => '2027-01-16',
            'end_date' => '2027-06-30',
            'is_current' => false,
            'order' => 2,
        ]);
    }
}
