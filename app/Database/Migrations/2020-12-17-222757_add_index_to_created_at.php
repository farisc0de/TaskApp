<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIndexToCreatedAt extends Migration
{
	public function up()
	{
		$this->db->simpleQuery('ALTER TABLE tasks ADD INDEX (created_at)');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->db->simpleQuery('ALTER TABLE tasks DROP INDEX (created_at)');
	}
}
