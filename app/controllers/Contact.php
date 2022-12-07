<?php

declare(strict_types=1);

namespace App\controllers;

use Core\Router;
use Core\Session;
use Core\Controller;
use App\models\Contacts;

defined('ROOT_PATH') or exit('Access Denied!');

class Contact extends Controller
{
    public function index()
    {
        $contacts = new Contacts();

        if($this->request->isPost()) {
            Session::csrfCheck();
            $fields = ['fullname', 'email', 'subject', 'message'];
            foreach ($fields as $field) {
                $contacts->{$field} = esc($this->request->getReqBody($field));
            }

            if($contacts->save()) {
                Session::msg("Message Sent, Thanks for contacting Us.", "success");
                Router::lastURL();
            }
        }

        $view = [
            'errors' => $contacts->getErrors(),
            'contact' => $contacts,
        ];
        $this->view->render('pages/contact', $view);
    }
}