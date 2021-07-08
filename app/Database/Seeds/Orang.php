<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Orang extends Seeder
{
	public function run()
	{
		$faker = \Faker\Factory::create('id_ID');
		//
		for ($i = 0; $i < 100; $i++) {

			$data = [
				'nama' => $faker->name,
				'alamat' => $faker->address
			];
			$this->db->table('dataorang')->insert($data);
		}
		// Simple Queries
		// $this->db->query("INSERT INTO users (username, email) VALUES(:username:, :email:)", $data);

		// Using Query Builder

	}
}
