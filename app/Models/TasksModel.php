<?php

namespace App\Models;

use CodeIgniter\Model;

class TasksModel extends Model
{
    protected $table = "tasks";

    protected $allowedFields = ['description', 'user_id'];

    protected $returnType = 'App\Entities\Task';

    protected $useTimestamps = true;

    protected $validationRules = [
        'description' => 'required'
    ];

    public function getTasksByUserId($id)
    {
        return $this->where('user_id', $id)
            ->orderBy('created_at')
            ->paginate(10);
    }


    public function getTaskByUserId($id, $user_id)
    {
        return $this->where('id', $id)
            ->where('user_id', $user_id)
            ->first();
    }

    public function search($term, $user_id)
    {

        if ($term == null) {
            return [];
        }

        return $this->select('id, description')
            ->where("user_id", $user_id)
            ->like("description", $term)
            ->get()
            ->getResultArray();
    }
}
