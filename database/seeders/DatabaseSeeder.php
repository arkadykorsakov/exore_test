<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		Category::factory()->count(50)->create();
		User::create(['email' => 'manager@mail.ru', 'password' => bcrypt('manager'), 'role' => Role::Manager]);
		User::create(['email' => 'manager1@mail.ru', 'password' => bcrypt('manager1'), 'role' => Role::Manager]);
		User::create(['email' => 'employee@mail.ru', 'password' => bcrypt('employee'), 'role' => Role::Employee, 'manager_id' => 1]);
		User::create(['email' => 'employee1@mail.ru', 'password' => bcrypt('employee1'), 'role' => Role::Employee, 'manager_id' => 2]);
	}
}
