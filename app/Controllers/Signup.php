<?php

namespace App\Controllers;

use App\Entities\User;
use App\Models\UsersModel;

class Signup extends BaseController
{
    public function new()
    {
        return view('Signup/new');
    }

    public function create()
    {
        $model = new UsersModel();

        $user = new User($this->request->getPost());

        $user->startActivation();

        if ($model->insert($user)) {
            $this->sendActivationEmail($user);

            return redirect()
                ->to('/signup/success')
                ->with('info', "account is created");
        } else {
            return redirect()
                ->back()
                ->with('errors', $model->errors())
                ->with('warning', 'something wrong')
                ->withInput();
        }
    }

    public function activate($token)
    {
        $model = new UsersModel();

        $model->activateByToken($token);

        return view('Signup/activated');
    }
    public function success()
    {
        return view('Signup/success');
    }

    public function sendActivationEmail($user)
    {
        $mail = service('email');

        $mail->setTo($user->email);

        $mail->setSubject('Account Activation');

        $message = view('Signup/activation_email', ["token" => $user->token]);

        $mail->setMessage($message);

        $mail->send();
    }
}
