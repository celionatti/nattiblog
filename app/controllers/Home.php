<?php

declare(strict_types=1);

namespace App\controllers;
use App\models\Subscribers;
use Core\Controller;
use App\models\Articles;


defined('ROOT_PATH') or exit('Access Denied!');

class Home extends Controller
{
    public function index()
    {
        $params = [
            'columns' => "articles.*, users.username, users.img, categories.category, categories.id as category_id",
            'conditions' => "articles.status = :status",
            'bind' => ['status' => 'published'],
            'joins' => [
                ['users', 'articles.user_id = users.uid'],
                ['categories', 'articles.category_id = categories.id', 'categories', 'LEFT']
            ],
            'order' => 'articles.id DESC'
        ];

        $trending_params = [
            'columns' => "articles.*, users.username, users.img, categories.category, categories.id as category_id",
            'conditions' => "articles.status = :status AND articles.trending = '1'",
            'bind' => ['status' => 'published'],
            'joins' => [
                ['users', 'articles.user_id = users.uid'],
                ['categories', 'articles.category_id = categories.id', 'categories', 'LEFT']
            ],
            'limit' => "3",
            'order' => 'articles.created_at DESC'
        ];

        $view = [
            'articles' => Articles::find($params),
            'trending_articles' => Articles::find($trending_params),
        ];
        $this->view->render('pages/home', $view);
    }

    public function subscribers()
    {
        $subscribers = new Subscribers();

        if(isset($_POST['add_subscribers'])) {
            $subscribers->email = esc($this->request->getReqBody('email'));
            $subscribers->status = 'active';

            if($subscribers->save()) {
                $this->jsonResponse("You are now Subscribe to our newsletter");
            } else {
                $this->jsonResponse("Something went wrong.");
            }
        }
    }
}