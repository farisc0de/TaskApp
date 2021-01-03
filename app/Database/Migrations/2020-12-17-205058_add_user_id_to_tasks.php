<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserIdToTasks extends Migration
{
	public function up()
	{
		$this->forge->addColumn('tasks', [
			"user_id" => [
				'type' => "INT",
				'constraint' => 11,
				'unsigned' => true,
			],
		]);

		$sql = "ALTER TABLE tasks 
				ADD CONSTRAINT task_user_id_fk 
				FOREIGN KEY (user_id) REFERENCES users(id)
				ON DELETE CASCADE ON UPDATE CASCADE";

		$this->db->simpleQuery($sql);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropForeignKey('tasks', 'task_user_id_fk');
		$this->forge->dropColumn('tasks', 'user_id');
	}
}
