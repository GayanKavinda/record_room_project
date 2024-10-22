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
            ['department_name' => 'Admin', 'department_no' => 1],
            ['department_name' => 'Planning', 'department_no' => 2],
            ['department_name' => 'Development', 'department_no' => 3],
            ['department_name' => 'Accounts', 'department_no' => 4],
            ['department_name' => 'Engineering', 'department_no' => 5],
            ['department_name' => 'Divisional Administration', 'department_no' => 6],
            ['department_name' => 'RAR (Regional Administration Reforms)', 'department_no' => 7],
            ['department_name' => 'District Admin', 'department_no' => 8],
            ['department_name' => 'Gramaniladari Division', 'department_no' => 9],
            ['department_name' => 'Divisional Administration', 'department_no' => 10],
            ['department_name' => 'Investigation', 'department_no' => 11],
            ['department_name' => 'Internal Audit', 'department_no' => 12],
            // Add more departments as needed
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}