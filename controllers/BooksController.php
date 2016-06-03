<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 03.06.16
 * Time: 20:18
 */
class BooksController
{
    public function actionIndex(){

        $books = Books::getLatestBooks();

        require_once ROOT.'/views/books/index.php';
        return true;
    }

}