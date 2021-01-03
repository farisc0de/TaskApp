<?php

namespace App\Controllers;

class Install extends BaseController
{
    public function index()
    {
        $migrate = \Config\Services::migrations();
        try {

            if ($migrate->latest()) {
                $seeder = \Config\Database::seeder();
                $seeder->call('UserSeeder');
            }

            echo "Software Installed";
        } catch (\Exception $e) {

            echo $e->getMessage();
        }
    }
}
