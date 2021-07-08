<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
	public function run()
	{
		$data = [
			'username' 	=> 'admin',
			'nama'    	=> 'admin',
			'password' 	=>  password_hash('123', PASSWORD_BCRYPT),
			'lvl' 		=> 1,
			'status' 	=> 1
		];

		// Simple Queries
		// $this->db->query("INSERT INTO users (username, email) VALUES(:username:, :email:)", $data);

		// Using Query Builder
		$this->db->table('user')->insert($data);
	}
}
