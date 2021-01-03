<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function new()
    {
        return view("Login/new");
    }

    public function create()
    {
        $username = esc($this->request->getPost('username'));
        $password = esc($this->request->getPost('password'));
        $remember_me = (bool) esc($this->request->getPost('remember_me'));

        $current_url = session('redirect_url') ?? '/';

        unset($_SESSION['redirect_url']);

        $status = service('auth')->login($username, $password, $remember_me);

        $msg = [];
        if ($status == 401 || $status == 404) {
            $msg = [
                'status' => 403,
                'code' => 'warning',
                "content" => 'Username or Password are incorrect'
            ];
        } elseif ($status == 200) {
            $msg = ['code' => 'info', "content" => 'Login OK'];
        } elseif ($status == 403) {
            $msg = ['code' => 'warning', "content" => 'Account is locked'];
        } elseif ($status == 400) {
            $msg = ['code' => 'warning', "content" => 'Account is not active'];
        } else {
            $msg = ['code' => 'warning', "content" => 'Error'];
        }

        if ($msg['code'] == 'info') {
            return redirect()->to($current_url)
                ->with($msg['code'], $msg['content'])
                ->withCookies();
        } else {
            return redirect()
                ->back()
                ->with($msg['code'], $msg['content'])
                ->withInput();
        }
    }

    public function delete()
    {
        service('auth')->logout();

        return redirect()
            ->to('/login/showLogoutMessage')
            ->withCookies();
    }

    public function showLogoutMessage()
    {
        return redirect()->to('/')
            ->with('info', "User has logout");
    }
}
