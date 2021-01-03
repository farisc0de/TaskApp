<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Profile extends BaseController
{
    /**
     * Undocumented variable
     *
     * @var \App\Entities\User
     */
    private $user;

    public function __construct()
    {
        $this->user = service('auth')->getCurrentUser();
    }

    public function show()
    {

        return view('Profile/show', [
            'user' => $this->user
        ]);
    }

    public function edit()
    {
        $session = session();

        if (!$session->has('can_edit_profile')) {
            return redirect()->to('/profile/auth');
        }

        if ($session->get('can_edit_profile') < time()) {
            return redirect()->to('/profile/auth');
        }

        return view("Profile/edit", [
            'user' => $this->user
        ]);
    }

    public function update()
    {
        $this->user->fill($this->request->getPost());

        if (!($this->user->hasChanged())) {

            return redirect()
                ->back()
                ->with("warning", "Nothing to update")
                ->withInput();
        }

        $model = new UsersModel();

        if ($model->save($this->user)) {
            session()->remove('can_edit_profile');

            return redirect()
                ->to("/profile/show")
                ->with('info', "record has been updated");
        } else {
            return redirect()
                ->back()
                ->with("errors", $model->errors())
                ->with('warning', "Invalid data")
                ->withInput();
        }
    }

    public function editPassword()
    {
        return view('Profile/edit_password');
    }

    public function updatePassword()
    {
        $model = new UsersModel();

        if (!$this->user->verfiyPassword($this->request->getPost('current_password'))) {
            return redirect()
                ->back()
                ->with("warning", "Invalid current password");
        }

        $this->user->fill($this->request->getPost());

        if ($model->save($this->user)) {
            return redirect()
                ->to("/profile/show")
                ->with('info', "password updated successfuly");
        } else {
            return redirect()
                ->back()
                ->with('errors', $model->errors())
                ->with('warning', 'Invalid data');
        }
    }

    public function auth()
    {
        return view('Profile/auth');
    }

    public function processAuth()
    {
        if ($this->user->verfiyPassword($this->request->getPost('password'))) {
            session()->set("can_edit_profile", time() + 300);

            return redirect()->to('/profile/edit');
        } else {
            return redirect()
                ->back()
                ->with('warning', 'Invalid Password');
        }
    }

    public function image()
    {
        if ($this->user->profile_image) {
            $path = WRITEPATH . 'uploads/profile_images/' . $this->user->profile_image;

            $finfo = new \finfo(FILEINFO_MIME);

            $type = $finfo->file($path);

            header("Content-Type: {$type}");
            header("Content-Length: " . filesize($path));

            readfile($path);

            exit;
        }
    }
}
