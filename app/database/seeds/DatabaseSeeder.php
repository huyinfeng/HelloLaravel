<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		/**
		 * Disable all mass assignable restrictions.
		 */
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		
		$this->command->info('User table seeded!');
	}

}
