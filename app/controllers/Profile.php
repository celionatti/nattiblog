<?php

declare(strict_types=1);

namespace App\controllers;

use Core\Router;
use Core\Session;
use Core\Controller;
use App\models\Contacts;

defined('ROOT_PATH') or exit('Access Denied!');

class Profile extends Controller
{
    public function index()
    {
        $view = [

        ];
        $this->view->render('pages/profile', $view);
    }
}
