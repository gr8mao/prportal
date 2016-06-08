<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 06.06.16
 * Time: 15:47
 */
class MoviesController
{
    public function actionIndex(){
        require_once ROOT.'/views/errors/405.php';
        return true;
    }
}