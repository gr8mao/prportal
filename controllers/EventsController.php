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

        $events = Events::getEventList();
        $currentMonth = 0;

        require_once ROOT.'/views/events/index.php';
        return true;
    }

    public function actionSubmit(){
        if (!Users::isGuest()) {

            $event_image = '';
            $errors = [];

            if (isset($_POST['submit'])) {
                $event_name = $_POST['name'];
                $event_place = $_POST['place'];
                $event_link = $_POST['link'];
                $event_date_start = $_POST['Date_start'];
                $event_date_end = $_POST['Date_end'];
                $event_annotation = $_POST['annotation'];

                $errors = false;

                if ($event_name == '') {
                    $errors[] = 'Укажите навзание мероприятия';
                }

                if ($event_place == '') {
                    $errors[] = 'Укажите место мероприятия';
                }

                if ($event_date_start == '') {
                    $errors[] = 'Укажите дату мероприятия';
                }

                if(!Users::checkLastModify(Users::checkLogged(),'Events'))
                {
                    $errors[] = 'Вы недавно отправляли сообщение. Это можно делать раз в 5 минут.';
                }

                $max_image_size = 1024* 10 * 1024;
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
                            if (move_uploaded_file($filename, ROOT . '/img/events/' . $_FILES['file']['name'])) {
                                $event_image = '/img/events/' . $_FILES['file']['name'];
                            } else {
                                $errors[] = 'Ошибка сервера: Ошибка переноса файла! Попробуйте позже!';
                            }
                        }
                    } else {
                        $errors[] = "Файл не может быть пустым!";
                    }
                }

                if(!filter_var($event_link, FILTER_VALIDATE_URL)){
                    $errors[] = "Введите корректную ссылку";
                }

                if ($errors == false) {
                    Events::saveEvent($event_name,$event_date_start,$event_date_end,$event_annotation,$event_place,$event_link,$event_image,Users::checkLogged());
                }
            }

            require_once ROOT.'/views/events/submit.php';
            return true;
        }

        header('Location: /error/401');
        return true;
    }

    public static function actionAboutEvent($id)
    {

        $event = Events::getEventByID($id);
        if ($event) {
            $added_by = Users::getUsernameById($event['Added_By']);
            $Comments = Сommentary::getSectionCommentary('Event', $id);

            require_once ROOT . '/views/events/event_view.php';
            return true;
        } else {
            header('Location: /error/404');
            return true;
        }

    }

    public static function actionCommentEvent($id)
    {
        $errors = [];

        if(!Users::isGuest()){
            if (isset($_POST['submit'])) {
                $comment_head = $_POST['title'];
                $comment_text = $_POST['comment'];

                $errors = false;

                if ($comment_head == '') {
                    $errors[] = 'Заголовок рецензии не заполнен';
                }

                if ($comment_text == '') {
                    $errors[] = 'Заполните текст рецензии';
                }

                if(!Users::checkLastModify(Users::checkLogged(),'Commentary'))
                {
                    $errors[] = 'Вы недавно отправляли сообщение. Это можно делать раз в 5 минут.';
                }

                if ($errors == false) {
                    Сommentary::saveComment(Users::checkLogged(),$comment_head,$comment_text,'Event',$id);
                    header('Location: /events/id'.$id);
                }

            }
            require_once ROOT . '/views/events/comment.php';
            return true;
        }

        header('Location: /error/401');
        return true;
    }
}