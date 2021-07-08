<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataOrang extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_orang' => [
				'type' 		=> 'INT',
				'constrain' => 11,
			],
			'nama'          => [
				'type'           => 'VARCHAR',
				'constraint'     => 255,
			],
			'alamat'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			]
		]);
		$this->forge->addKey('id_orang', true);
		$this->forge->createTable('DataOrang');
	}

	public function down()
	{
		$this->forge->dropTable('DataOrang');
	}
}
