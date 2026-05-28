<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:create-admin-user')]
#[Description('Create admin user if not exists')]
class CreateAdminUser extends Command
{
    public function handle()
    {
        User::updateOrCreate(
            ['email' => 'admin@lista.site'],
            [
                'name' => 'Admin',
                'password' => '1234',
                'role' => User::ROLE_ADMIN,
            ]
        );

        $this->info('Admin user created/updated with admin role.');
    }
}
