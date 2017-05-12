<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 05.05.17
 * Time: 0:40
 */
class NewsController
{
    public static function actionIndex(){
        $global_news = News::getGlobalNews();
        $local_news = News::getLocalNews();

        require_once ROOT.'/views/news/index.php';
        return true;
    }

    public static function actionSubmit()
    {
        if (!Users::isGuest()) {
            $news_image = '';
            $errors = [];

            if (isset($_POST['submit'])) {
                $news_header = $_POST['header'];
                $news_text = $_POST['text'];
                $news_location = $_POST['location'];


                $errors = false;

                if ($news_header == '') {
                    $errors[] = 'Заголовок новости не заполнен';
                }

                if ($news_text == '') {
                    $errors[] = 'Заполните текст новости';
                }

                if ($news_location == '') {
                    $errors[] = 'Выберите локацию новости';
                }

                if(!Users::checkLastModify(Users::checkLogged(),'News'))
                {
                    $errors[] = 'Вы недавно отправляли сообщение. Это можно делать раз в 5 минут.';
                }

                $max_image_size = 1024 * 1024 * 10;
                $valid_types = array("gif", "jpg", "png", "jpeg");

                if (isset($_FILES["file"])) {
                    if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                        $filename = $_FILES['file']['tmp_name'];
                        $ext = substr($_FILES['file']['name'], 1 + strrpos($_FILES['file']['name'], "."));
                        if (filesize($filename) > $max_image_size) {
                            $errors[] = 'Файл слишком большой';
                        } elseif (!in_array($ext, $valid_types)) {
                            $errors[] = 'Неразрешенный формат файла';
                        } else {
                            if (move_uploaded_file($filename, ROOT . '/img/news/' . $_FILES['file']['name'])) {
                                $news_image = '/img/news/' . $_FILES['file']['name'];
                            } else {
                                $errors[] = 'Ошибка сервера: Ошибка переноса файла! Попробуйте позже!';
                            }
                        }
                    } else {
                        $errors[] = "Файл не может быть пустым!";
                    }
                }

                if ($errors == false) {
                    News::addNews($news_header,$news_text,$news_location,$news_image,Users::checkLogged());
                }
            }

            require_once ROOT . '/views/news/submit.php';
            return true;
        }

        header('Location: /error/401');
        return true;
    }
}