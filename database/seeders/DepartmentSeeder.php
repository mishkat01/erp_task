<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['name' => 'Human Resources'],
            ['name' => 'Finance'],
            ['name' => 'Operations'],
            ['name' => 'Procurement'],
            ['name' => 'Sales'],
            ['name' => 'IT'],
            ['name' => 'Marketing'],
        ];

        foreach ($departments as $department) {
            Department::firstOrCreate(
                ['name' => $department['name']],
                $department
            );
        }
    }
}
