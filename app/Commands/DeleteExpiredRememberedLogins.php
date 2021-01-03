<?php

namespace App\Commands;

use App\Models\RememberedLoginModel;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class DeleteExpiredRememberedLogins extends BaseCommand
{
    protected $group       = 'auth';
    protected $name        = 'auth:cleanup';
    protected $description = 'Delete expired remembered logins';

    public function run(array $params)
    {
        $model = new RememberedLoginModel();

        $rows = $model->deleteExpired();

        echo "{$rows} rows deleted. \n";
    }
}
