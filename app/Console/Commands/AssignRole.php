<?php

namespace App\Console\Commands;

use App\Models\Employee;
use Illuminate\Console\Command;

class AssignRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:assign-role {email} {role}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign a role to a user. Roles: employee, procurement, manager';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $role = $this->argument('role');

        $validRoles = ['employee', 'procurement', 'manager'];

        if (!in_array($role, $validRoles)) {
            $this->error("Invalid role. Valid roles are: " . implode(', ', $validRoles));
            return 1;
        }

        $user = Employee::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email {$email} not found.");
            return 1;
        }

        $user->update(['role' => $role]);

        $this->info("Role '{$role}' assigned to {$email}");
        return 0;
    }
}
