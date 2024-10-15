<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\File;

class FilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        File::create([
            'file_no' => 1,
            'responsible_officer' => 'Alice Smith',
            'open_date' => '2024-01-01',
            'close_date' => '2024-12-31',
        ]);

        File::create([
            'file_no' => 2,
            'responsible_officer' => 'Bob Johnson',
            'open_date' => '2024-02-01',
            'close_date' => null,
        ]);

        File::create([
            'file_no' => 3,
            'responsible_officer' => 'Charlie Brown',
            'open_date' => '2024-03-01',
            'close_date' => '2024-09-30',
        ]);
    }
}
