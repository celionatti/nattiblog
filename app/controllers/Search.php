<?php

declare(strict_types=1);

namespace App\controllers;

use Core\Router;
use Core\Controller;
use App\models\Articles;
use Core\Helpers;
use Core\Session;

defined('ROOT_PATH') or exit('Access Denied!');

class Search extends Controller
{
    public function index()
    {
        if(!isset($_GET['search'])) {
            Session::msg("You can't access Search Page with no Params. Try again with search Query Next time.");
            Router::redirect('');
        }

        $search = esc($_GET['search']);

        $params = [
            'columns' => "articles.*, users.username, users.img, categories.category, categories.id as category_id",
            'conditions' => "articles.status = :status AND articles.title LIKE :t_search OR articles.content LIKE :c_search OR categories.category LIKE :cat_search",
            'bind' => ['status' => 'published', 't_search' => "%$search%", 'c_search' => "%$search%", 'cat_search' => "%$search%"],
            'joins' => [
                ['users', 'articles.user_id = users.uid'],
                ['categories', 'articles.category_id = categories.id', 'categories', 'LEFT']
            ],
            'order' => 'articles.id DESC'
        ];

        $params = Articles::mergeWithPagination($params);
        $total = Articles::findTotal($params);

        $view = [
            'articles' => Articles::find($params),
            'total' => $total,
        ];
        $this->view->render('pages/search', $view);
        
    }
}