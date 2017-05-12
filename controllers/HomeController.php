<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 14.05.16
 * Time: 20:48
 */
class HomeController
{
    public function actionIndex()
    {

        require_once(ROOT . '/views/home/index.php');
        return true;
    }


    public function actionAbout()
    {

        require_once(ROOT . '/views/home/about.php');
        return true;
    }
}