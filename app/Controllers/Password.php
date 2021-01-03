<?php

namespace APP\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Password extends BaseController
{
    public function forget()
    {
        return view("Password/forget");
    }

    public function process()
    {
        $model = new \App\Models\UsersModel();

        $user = $model->findByEmail($this->request->getPost("email"));

        if ($user && $user->is_active) {
            $user->startPasswordReset();

            $model->save($user);

            $this->sendResetEmail($user);

            return redirect()->to("/password/emailsent");
        } else {
            return redirect()
                ->back()
                ->with("warning", "No active user found with that email address")
                ->withInput();
        }
    }

    private function sendResetEmail($user)
    {
        $mail = service('email');

        $mail->setTo($user->email);

        $mail->setSubject('Password Reset');

        $message = view('Password/reset_email.php', ["token" => $user->reset_token]);

        $mail->setMessage($message);

        $mail->send();
    }

    public function emailsent()
    {
        return view("Password/email_sent");
    }

    public function reset($token)
    {
        $model = new UsersModel();

        $user = $model->getUserForPasswordReset($token);

        if ($user) {
            return view("Password/reset", [
                'token' => $token
            ]);
        } else {
            return redirect()
                ->back()
                ->with("warning", "Link invalid or has expired, Please try again");
        }
    }

    public function success()
    {
        return view("Password/reset_success");
    }

    public function update($token)
    {
        $model = new UsersModel();

        $user = $model->getUserForPasswordReset($token);

        if ($user) {
            $user->fill($this->request->getPost());

            if ($model->save($user)) {

                $user->complatePasswordReset();

                $model->save($user);

                return redirect()->to("/password/success");
            } else {
                return redirect()
                    ->back()
                    ->with('errors', $model->errors())
                    ->with("warning", "Invalid Data");
            }
        } else {
            return redirect()
                ->back()
                ->with("warning", "Link invalid or has expired, Please try again");
        }
    }
}
