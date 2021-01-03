<?php

namespace App\Libraries;

use App\Models\RememberedLoginModel;
use App\Models\UsersModel;

class Authentication
{
    private $user;

    public function login($username, $password, $remember_me)
    {
        $total_failed_login = 5;
        $lockout_time = 10;
        $account_locked = false;

        $model = new UsersModel();

        $user = $model->findByUsername($username);

        if ($user != null) {
            if (($model->countAllResults() >= 1) && ($user->failed_login >= $total_failed_login)) {
                $last_login = strtotime($user->last_login);

                $timeout = $last_login + ($lockout_time * 60);

                $timenow = time();

                if ($timenow < $timeout) {
                    $account_locked = true;

                    return 403;
                }
            }

            if (
                ($model->countAllResults() >= 1) &&
                ($user->verfiyPassword($password)) &&
                ($account_locked == false)
            ) {
                if ($user->is_active) {
                    $last_login = $user->last_login;

                    $model->updateUsername('failed_login', 0, $username);

                    $this->logInUser($user);

                    if ($remember_me) {
                        $this->rememberLogin($user->id);
                    }

                    return 200;
                } else {
                    return 400;
                }
            } else {
                sleep(rand(2, 4));

                $model->updateUsername('failed_login', $user->failed_login + 1, $username);

                return 401;
            }

            $model->updateUsername('last_login', now(), $username);
        } else {
            return 404;
        }
    }

    public function logInUser($user)
    {
        $session = session();
        $session->regenerate();
        $session->set('user_id', $user->id);
    }

    public function logout()
    {
        session()->destroy();

        $token = service('request')->getCookie('remember_me');

        if ($token !== null) {
            $model = new RememberedLoginModel();

            $model->deleteByToken($token);
        }

        service('response')->deleteCookie('remember_me');
    }

    public function getUserFromSession()
    {
        if (!(session()->has('user_id'))) {
            return null;
        }

        $model = new UsersModel();

        $user = $model->find(session('user_id'));

        if ($user && $user->is_active) {
            return $user;
        }
    }

    public function getUserFromCookie()
    {
        $request = service('request');

        $token = $request->getCookie('remember_me');

        if ($token == null) {
            return null;
        }

        $remembered_login_model = new RememberedLoginModel();

        $remembered_login = $remembered_login_model->findByToken($token);

        if ($remembered_login == null) {
            return null;
        }

        $user_model = new UsersModel();

        $user = $user_model->find($$remembered_login['user_id']);

        if ($user && $user->is_active) {
            $this->logInUser($user);

            return $user;
        }
    }

    public function getCurrentUser()
    {
        if ($this->user == null) {

            $this->user = $this->getUserFromSession();
        }

        if ($this->user == null) {

            $this->user = $this->getUserFromCookie();
        }

        return $this->user;
    }

    public function isLoggedIn()
    {
        return $this->getCurrentUser() !== null;
    }

    private function rememberLogin($user_id)
    {
        $model = new RememberedLoginModel();

        list($token, $expires_at) = $model->rememberUserLogin($user_id);

        $response = service('response');

        $response->setCookie('remember_me', $token, $expires_at);
    }
}
