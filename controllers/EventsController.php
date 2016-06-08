<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 06.06.16
 * Time: 15:48
 */
class EventsController
{
    public function actionIndex(){
        require_once ROOT.'/views/errors/405.php';
        return true;
    }
}