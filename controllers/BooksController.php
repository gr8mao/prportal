<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 03.06.16
 * Time: 20:18
 */
class BooksController
{
    public function actionIndex()
    {

        $books = Books::getLatestBooks();

        require_once ROOT . '/views/books/index.php';
        return true;
    }

    public function actionSubmit()
    {

        if (!Users::isGuest()) {
            $book_image = '';
            $errors = [];

            if (isset($_POST['submit'])) {
                $book_author = $_POST['author'];
                $book_name = $_POST['name'];
                $book_annotation = $_POST['annotation'];
                $book_genre = $_POST['genre'];
                $book_year = $_POST['year'];
                $book_link = $_POST['link'];

                $errors = false;

                if ($book_author == '') {
                    $errors[] = 'Заголовок статьи не заполнен';
                }

                if ($book_name == '') {
                    $errors[] = 'Заполните поле "Имя и фамилия"';
                }

                if ($book_annotation == '') {
                    $errors[] = 'Не заполнена статья';
                }

                if (!filter_var($book_link, FILTER_VALIDATE_URL)) {
                    $errors[] = 'Введите корректную ссылку';
                }

                if(!Users::checkLastModify(Users::checkLogged(),'Books'))
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
//                            $size = GetImageSize($filename);
//                            if (($size) && ($size[0] < $max_image_width)
//                                && ($size[1] < $max_image_height)
//                            ) {
                            if (move_uploaded_file($filename, ROOT . '/img/books/' . $_FILES['file']['name'])) {
                                $book_image = '/img/books/' . $_FILES['file']['name'];
                            } else {
                                $errors[] = 'Ошибка сервера: Ошибка переноса файла! Попробуйте позже!';
                            }
//                            } else {
//                                $errors[] = 'Неразрешенное соотношение сторон изображения (Разрешено до 380x600)';
//                            }
                        }
                    } else {
                        $errors[] = "Файл не может быть пустым!";
                    }
                }

                if ($errors == false) {
                    Books::saveBook($book_name, $book_author, $book_annotation, $book_image, $book_genre, $book_year, $book_link, Users::checkLogged());
                }
            }

            require_once ROOT . '/views/books/submit.php';
            return true;
        }

        header('Location: /error/401');
        return true;
    }

    public static function actionAboutBook($id)
    {

        $book = Books::getBookByID($id);
        if ($book) {
            $Added_By = Users::getUsernameById($book['Added_By']);
            $Comments = Сommentary::getSectionCommentary('Books', $id);

            require_once ROOT . '/views/books/book_view.php';
            return true;
        } else {
            header('Location: /error/404');
            return true;
        }

    }

    public static function actionCommentBook($id)
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
                    Сommentary::saveComment(Users::checkLogged(),$comment_head,$comment_text,'Books',$id);
                    header('Location: /books/id'.$id);
                }
            }
            require_once ROOT . '/views/books/comment.php';
            return true;
        }

        header('Location: /error/401');
        return true;
    }

}