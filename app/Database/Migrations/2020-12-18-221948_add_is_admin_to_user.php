<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIsAdminToUser extends Migration
{
	public function up()
	{
		$this->forge->addColumn('users', [
			'is_admin' => [
				'type' => 'boolean',
				'null' => false,
				'default' => false
			]
		]);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropColumn('users', 'is_admin');
	}
}
