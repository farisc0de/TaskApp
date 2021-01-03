<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTask extends Migration
{
	public function up()
	{
		$this->forge->addField([
			"id" => [
				'type' => "INT",
				'constraint' => 11,
				'unsigned' => true,
				'auto_increment' => true
			],
			"description" => [
				'type' => "VARCHAR",
				'constraint' => 225,
			],
			'created_at' => [
				'type'     => 'DATETIME',
				'null'     => true,
				'default'  => null
			],
			'updated_at' => [
				'type'     => 'DATETIME',
				'null'     => true,
				'default'  => null
			]
		]);

		$this->forge->addPrimaryKey("id");

		$this->forge->createTable("tasks");
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable("tasks");
	}
}
