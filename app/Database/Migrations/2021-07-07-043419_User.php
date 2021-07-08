<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_user'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'auto_increment' => true,
			],
			'username'       => [
				'type'       => 'VARCHAR',
				'constraint' => 200,
			],
			'nama' => [
				'type' 		 => 'VARCHAR',
				'constraint' => 255
			],
			'password' => [
				'type' 		=> 'VARCHAR',
				'constraint' => 255
			],
			'lvl' => [
				'type'		=> 'TINYINT',
				'constraint' => 1,
			],
			'status' => [
				'type'		=> 'TINYINT',
				'constraint' => 1,
			]
		]);
		$this->forge->addKey('id_user', true);
		$this->forge->createTable('user');
	}

	public function down()
	{
		$this->forge->dropTable('user');
	}
}
