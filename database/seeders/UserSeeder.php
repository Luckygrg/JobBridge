<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // --- Seekers ---
        $seekers = [
            ['name' => 'Alice Johnson', 'email' => 'alice@example.com',  'password' => 'password'],
            ['name' => 'Bob Smith',      'email' => 'bob@example.com',   'password' => 'password'],
            ['name' => 'Carol White',    'email' => 'carol@example.com', 'password' => 'password'],
            ['name' => 'David Brown',    'email' => 'david@example.com', 'password' => 'password'],
            ['name' => 'Eva Green',      'email' => 'eva@example.com',   'password' => 'password'],
            ['name' => 'Frank Lee',      'email' => 'frank@example.com', 'password' => 'password'],
            ['name' => 'Grace Kim',      'email' => 'grace@example.com', 'password' => 'password'],
            ['name' => 'Henry Adams',    'email' => 'henry@example.com', 'password' => 'password'],
            ['name' => 'Isla Turner',    'email' => 'isla@example.com',  'password' => 'password'],
            ['name' => 'Jack Wilson',    'email' => 'jack@example.com',  'password' => 'password'],
        ];

        foreach ($seekers as $s) {
            User::updateOrCreate(
                ['email' => $s['email']],
                [
                    'name'              => $s['name'],
                    'password'          => Hash::make($s['password']),
                    'role'              => 'seeker',
                    'email_verified_at' => now(),
                ]
            );
        }

        // --- Employers ---
        $employers = [
            [
                'name'          => 'Rebecca Simons',
                'company_name'  => 'Rebs Corp',
                'email'         => 'rebs@gmail.com',
                'company_phone' => '0123456789',
                'password'      => 'password',
            ],
            [
                'name'          => 'John Tech',
                'company_name'  => 'TechNova Sdn Bhd',
                'email'         => 'john@technova.com',
                'company_phone' => '0198765432',
                'password'      => 'password',
            ],
            [
                'name'          => 'Lisa Hire',
                'company_name'  => 'HireUp Agency',
                'email'         => 'lisa@hireup.com',
                'company_phone' => '0171122334',
                'password'      => 'password',
            ],
        ];

        foreach ($employers as $e) {
            User::updateOrCreate(
                ['email' => $e['email']],
                [
                    'name'              => $e['name'],
                    'password'          => Hash::make($e['password']),
                    'role'              => 'employer',
                    'company_name'      => $e['company_name'],
                    'company_phone'     => $e['company_phone'],
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}
