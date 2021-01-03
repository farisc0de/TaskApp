<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
	public function run()
	{
		$model = new \App\Models\UsersModel();

		$data = [
			'username' => 'admin',
			'email' => 'demo@demo.com',
			'password' => 'admin',
			'is_admin' => true,
			'is_active' => true
		];

		$model->skipValidation(true)
			->protect(false)
			->insert($data);
	}
}
