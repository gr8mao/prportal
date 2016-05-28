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

        require_once (ROOT.'/articles.html');

        Article::getArticles();
        return true;
    }

}