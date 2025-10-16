<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class InitialAppSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $this->info('Migrating the database...');

            $this->call('db:seed');


        $permissions = getSystemPermissions();

        $roles=[

            [
                'name'=>'Super Admin',
                'permissions'=>[
                    $permissions
                ]
            ],

        ];


        $this->info('Creating Permissions...');

        foreach ($permissions as $permission) {
            $this->call('permission:create-permission', [
                'name' => $permission,
            ]);
        }


        $this->info('Done...');

        $this->info('Creating Roles...');

        foreach ($roles as $role) {
            $this->call('permission:create-role', [
                'name' => $role['name'],
            ]);
            $userRole = Role::findByName($role['name']);
            $userRole->syncPermissions($role['permissions']);
        }

        $this->info('Done...');

        $this->info('Assigning Roles To Super Admin...');

        User::find(1)->syncRoles('Super Admin');

        $this->info('Bringing application up...');
        $this->call('up');
        $this->info('The project is set up!');

        return self::SUCCESS;

    }
}
