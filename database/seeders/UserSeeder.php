<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Vanessa Detera',
            'email' => 'vanessa@admin.com',
            'password' => bcrypt('vanessa@1234'),
            'role' => 'Administrator'
        ]);

        User::create([
            'name' => 'Tong Martos',
            'email' => 'tong@employee.com',
            'password' => bcrypt('tong@1234'),
            'designation' => 'Part-Time I.T. Instructor',
            'office' => 'Faculty Office',
            'role' => 'Employee'
        ]);
    }
}
