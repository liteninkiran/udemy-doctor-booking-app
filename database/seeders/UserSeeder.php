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
        User::factory(1)->create(['role_id' => 1, 'department_id' => null]);
        User::factory(10)->create(['role_id' => 2]);
        User::factory(100)->create(['role_id' => 3, 'department_id' => null]);
    }
}
