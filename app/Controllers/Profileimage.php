<?php

namespace App\Controllers;

use App\Models\UsersModel;
use PDO;

class Profileimage extends BaseController
{
    public function edit()
    {
        return view("Profileimage/edit");
    }

    public function update()
    {
        $file = $this->request->getFile('image');

        $error_code = $file->getError();

        if (!$file->isValid()) {
            if ($error_code == UPLOAD_ERR_NO_FILE) {
                return redirect()
                    ->back()
                    ->with('warning', 'No file was selected');
            }
            throw new \RuntimeException($file->getErrorString());
        }

        $size = $file->getSizeByUnit("mb");

        if ($size > 2) {
            return redirect()
                ->back()
                ->with("warning", "File too large (2 MB)");
        }

        $mime = $file->getMimeType();

        if (!in_array($mime, ['image/png', 'image/jpg', 'image/jpeg'])) {
            return redirect()
                ->back()
                ->with('warning', 'Invalid file format (PNG or JPG only)');
        }

        $path = $file->store('profile_images');

        $path = WRITEPATH . 'uploads/' . $path;

        service('image')
            ->withFile($path)
            ->fit(200, 200, 'center')
            ->save($path);

        $user = service('auth')->getCurrentUser();

        $user->profile_image = $file->getName();

        $model = new UsersModel();

        $model->save($user);

        return redirect()
            ->to('/profile/show')
            ->with('info', 'Image uploaded successfully');
    }

    public function delete()
    {
        if ($this->request->getMethod() == 'post') {
            echo "Hello";
            $user = service('auth')->getCurrentUser();

            $path = WRITEPATH . 'uploads/profile_images/' . $user->profile_image;

            if (is_file($path)) {
                unlink($path);
            }

            $user->profile_image = null;

            $model = new UsersModel();

            $model->save($user);

            return redirect()
                ->to('/profile/show')
                ->with('info', 'Image deleted');
        }

        return view('Profileimage/delete');
    }
}
