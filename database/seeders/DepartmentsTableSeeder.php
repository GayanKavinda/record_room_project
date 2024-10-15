<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department; // Import the Department model


class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Sample departments to insert
        $departments = [
            ['department_name' => 'HR', 'department_no' => 1],
            ['department_name' => 'IT', 'department_no' => 2],
            ['department_name' => 'Finance', 'department_no' => 3],
            ['department_name' => 'Sales', 'department_no' => 4],
            // Add more departments as needed
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
