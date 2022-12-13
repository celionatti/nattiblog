<?php

declare(strict_types=1);

namespace App\controllers;

use Core\Router;
use Core\Helpers;
use Core\Session;
use Core\Controller;
use App\models\Image;
use App\models\Users;
use Core\helpers\FileUpload;

defined('ROOT_PATH') or exit('Access Denied!');

class Profile extends Controller
{
    public $currentUser;

    public function onConstruct()
    {
        $this->currentUser = Users::getCurrentUser();
    }

    public function index()
    {
        $view = [
            'user' => $this->currentUser,
        ];
        $this->view->render('profile/profile', $view);
    }

    public function edit()
    {
        $user = Users::findById($this->currentUser->id);

        if (!$user) {
            Session::msg("You do not have permission to edit this user");
            Router::redirect('');
        }

        if ($this->request->isPost()) {
            Session::csrfCheck();
            $fields = ['fname', 'lname', 'username', 'email', 'phone'];
            foreach ($fields as $field) {
                $user->{$field} = esc($this->request->getReqBody($field));
            }
            $upload = new FileUpload('img');

            // $upload->required = true;

            $uploadErrors = $upload->validate();

            if (!empty($uploadErrors)) {
                foreach ($uploadErrors as $field => $error) {
                    $user->setError($field, $error);
                }
            }

            /** Set end one Image Upload validation and Upload */

            if (empty($user->getErrors())) {
                $upload->directory('uploads/users');

                if ($user->save()) {
                    if (!empty($upload->tmp)) {

                        if ($upload->upload()) {
                            if (!is_null($user->img) && file_exists($user->img)) {
                                unlink($user->img);
                                $user->img = "";
                            }
                            $user->img = $upload->fc;
                            $image = new Image();
                            $image->resize($user->img);
                            $user->save();
                        }
                    }
                    Session::msg("{$user->username} Updated Successfully!.", 'success');
                    Router::redirect('profile');
                }
            }
        }

        $view = [
            'errors' => $user->getErrors(),
            'user' => $user,
        ];
        $this->view->render('profile/edit', $view);
    }

    public function change_password()
    {
        $user = Users::findById($this->currentUser->id);

        if (!$user) {
            Session::msg("You do not have permission to edit this user");
            Router::redirect('');
        }

        if ($this->request->isPost()) {
            Session::csrfCheck();
            $user->old_password = esc($this->request->getReqBody('old_password'));
            $user->new_password = esc($this->request->getReqBody('new_password'));
            $user->confirm_password = esc($this->request->getReqBody('confirm_password'));

            $user->validateChangePassword();

            if (empty($user->getErrors())) {
                $verified = password_verify($user->old_password, $user->password);
                if (!$verified) {
                    $user->setError('old_password', 'Old Password is not Correct');
                }

                if ($verified) {
                    $user->password = password_hash($user->new_password, PASSWORD_DEFAULT, ['cost' => 12]);
                    $data = ['password' => $user->password];
                    if($user->update($data, ['id' => $user->id])) {
                        Session::msg("Password Changed Successfully!.", "success");
                        Router::redirect('profile');
                    }
                }
            }
        }

        $view = [
            'errors' => $user->getErrors(),
            'user' => $user,
        ];
        $this->view->render('profile/change_password', $view);
    }
}
