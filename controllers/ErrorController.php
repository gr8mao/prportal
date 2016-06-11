<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 10.06.16
 * Time: 16:38
 */
class ErrorController
{
    public function actionExecute($err_code) {
        include_once ROOT."/views/errors/$err_code.php";
        return true;
    }
}