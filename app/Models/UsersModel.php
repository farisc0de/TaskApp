<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Token;

class UsersModel extends Model
{
    protected $table = "users";

    protected $allowedFields = [
        'username',
        'email',
        'password',
        'failed_login',
        'last_login',
        'activation_hash',
        'reset_hash',
        'reset_expires_at',
        'profile_image'
    ];

    protected $returnType = 'App\Entities\User';

    protected $useTimestamps = true;

    protected $validationRules = [
        'username' => 'required',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]',
        'password_confirmation' => 'required|matches[password]'
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'That email address is taken'
        ],
        'password_confirmation' => [
            'required' => 'Please confirm the password',
            'matches' => 'Please enter the same password again'
        ]
    ];

    protected $beforeInsert = ['hashPassword'];

    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);

            unset($data['data']['password']);
            unset($data['data']['password_confirmation']);
        }

        return $data;
    }

    public function findByUsername($username)
    {
        return $this->where('username', $username)->first();
    }

    public function findByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function updateUsername($key, $value, $username)
    {
        $this->set($key, $value)
            ->where('username', $username)
            ->update();
    }

    public function disablePasswordValidation()
    {
        unset($this->validationRules['password']);

        unset($this->validationRules['password_confirmation']);
    }

    public function activateByToken($token)
    {
        $token = new Token($token);

        $user = $this->where("activation_hash", $token->getHash())->first();

        if ($user != null) {
            $user->activate();

            $this->protect(false)->save($user);
        } else {
            return false;
        }
    }

    public function getUserForPasswordReset($token)
    {
        $token = new Token($token);

        $hash = $token->getHash();

        $user = $this->where("reset_hash", $hash)->first();

        if ($user) {
            if (strtotime($user->reset_expires_at) < time()) {
                $user = null;
            }
        }

        return $user;
    }
}
