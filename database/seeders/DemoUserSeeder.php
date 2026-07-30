<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $department = Department::first();

        $accounts = [
            [
                'name' => 'Demo Employee',
                'email' => 'employee@demo.test',
                'role' => 'employee',
                'department_id' => $department?->id,
            ],
            [
                'name' => 'Demo Procurement',
                'email' => 'procurement@demo.test',
                'role' => 'procurement',
                'department_id' => null,
            ],
            [
                'name' => 'Demo Manager',
                'email' => 'manager@demo.test',
                'role' => 'manager',
                'department_id' => null,
            ],
        ];

        foreach ($accounts as $account) {
            Employee::firstOrCreate(
                ['email' => $account['email']],
                [
                    'name' => $account['name'],
                    'role' => $account['role'],
                    'department_id' => $account['department_id'],
                    'password' => Hash::make('password'),
                ]
            );
        }
    }
}
