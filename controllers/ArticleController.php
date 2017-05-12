<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 28.05.16
 * Time: 9:03
 */
class ArticleController
{

    public function actionIndex(){

        $articles = Article::getApprovedArticles();

        require_once (ROOT.'/views/articles/index.php');

        return true;
    }

    public function actionSubmit(){

        if(!Users::isGuest()) {
            $errors = [];

            if (isset($_POST['submit'])) {
                $article_title = $_POST['title'];
                $article_content = $_POST['content'];

                $errors = false;

                if ($article_title == '') {
                    $errors[] = 'Заголовое статьи не заполнен';
                }

                if ($article_content == '') {
                    $errors[] = 'Не заполнена статья';
                }

                if(!Users::checkLastModify(Users::checkLogged(),'Articles'))
                {
                    $errors[] = 'Вы недавно отправляли сообщение. Это можно делать раз в 5 минут.';
                }

                if ($errors == false) {
                    Article::saveArticle($article_title, $article_content, Users::checkLogged());
                }
            }

            require_once ROOT . '/views/articles/submit.php';
            return true;
        }
        header('Location: /error/401');
        return true;
    }

}