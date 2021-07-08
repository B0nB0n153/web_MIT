<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Post extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_post'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'auto_increment' => true,
			],
			'foto'       => [
				'type'       => 'VARCHAR',
				'constraint' => 255,
			],
			'tgl_post' => [
				'type' 		 => 'DATE',
			],
			'judul' => [
				'type' 		=> 'VARCHAR',
				'constraint' => 255
			],
			'deskripsi' => [
				'type'		=> 'TEXT',
			],

		]);
		$this->forge->addKey('id_user', true);
		$this->forge->createTable('user');
	}

	public function down()
	{
		$this->forge->dropTable('user');
	}
}
