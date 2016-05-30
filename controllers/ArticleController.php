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

        $articles = Article::getArticles();

        require_once (ROOT.'/views/articles/index.php');

        return true;
    }

    public function actionSubmit(){

        $article_title = '';
        $article_content = '';
        $article_author = '';



        if(isset($_POST['submit'])){
            $article_title = $_POST['title'];
            $article_content = $_POST['content'];
            $article_author = $_POST['author'];

            $errors = false;

            if($article_title == '') {
                $errors[] = 'Заголовое статьи не заполнен';
            }

            if($article_author == ''){
                $errors[] = 'Заполните поле "Имя и фамилия"';
            }

            if($article_content == ''){
                $errors[] = 'Не заполнена статья';
            }

            if($errors == false){
                Article::saveArticle($article_title,$article_content,$article_author);
            }
        }

        require_once ROOT.'/views/articles/submit.php';
        return true;
    }

}