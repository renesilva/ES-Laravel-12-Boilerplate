<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UserExamplesInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:user-examples-init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initializes an example system with Super Admin (user management) and Admin users';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Initializing the example system ...');
        $this->call('db:seed', [
            'class' => 'UsersExamplesSeeder',
        ]);
        $this->call('permission:create-role', ['name' => 'super-admin', 'guard' => 'api']);

        $this->call('permission:create-role', [
            'name' => 'admin',
            'guard' => 'api',
            'permissions' => implode('|', []),
        ]);

        // Assign roles
        $superadmin = User::where('email', '=', 'superadmin@test.com')->first();
        $superadmin->assignRole('super-admin');
        $businessManager = User::where('email', '=', 'test@test.com')->first();
        $businessManager->assignRole('admin');

        $this->info('Example system initialized successfully!');
    }
}
