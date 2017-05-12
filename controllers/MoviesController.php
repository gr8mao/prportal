<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 06.06.16
 * Time: 15:47
 */
class MoviesController
{
    public function actionIndex()
    {

        $movies = Movies::getLatestMovies();

        require_once ROOT . '/views/movies/index.php';
        return true;
    }

    public static function actionSubmit()
    {
        if (!Users::isGuest()) {
            $movie_image = '';
            $errors = [];

            if (isset($_POST['submit'])) {
                $movie_country = $_POST['country'];
                $movie_name = $_POST['name'];
                $movie_annotation = $_POST['annotation'];
                $movie_genre = $_POST['genre'];
                $movie_year = $_POST['year'];
                $movie_link = $_POST['link'];

                $errors = false;

                if ($movie_name == '') {
                    $errors[] = 'Заполните навзание фильма';
                }

                if ($movie_annotation == '') {
                    $errors[] = 'Не заполнена статья';
                }

                if(!filter_var($movie_link,FILTER_VALIDATE_URL))
                {
                    $errors[] = 'Введите корректную ссылку';
                }

                if(!Users::checkLastModify(Users::checkLogged(),'Movies'))
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
                            if (move_uploaded_file($filename, ROOT . '/img/movies/'.$_FILES['file']['name'])) {
                                $movie_image = '/img/movies/' . $_FILES['file']['name'];
                            } else {
                                $errors[] = 'Ошибка сервера: Ошибка переноса файла! Попробуйте позже!';
                            }
                        }
                    } else {
                        $errors[] = "Файл не может быть пустым!";
                    }
                }

                if ($errors == false) {
                    Movies::saveMovie($movie_name, $movie_country, $movie_year, $movie_annotation, $movie_genre, $movie_image, $movie_link, Users::checkLogged());
                }
            }

            require_once ROOT . '/views/movies/submit.php';
            return true;
        }

        header('Location: /error/401');
        return true;
    }

    public static function actionAboutMovie($id)
    {

        $movie = Movies::getMovieByID($id);
        if ($movie) {
            $Added_By = Users::getUsernameById($movie['Added_By']);
            $Comments = Сommentary::getSectionCommentary('Movies', $id);

            require_once ROOT . '/views/movies/movie_view.php';
            return true;
        } else {
            header('Location: /error/404');
            return true;
        }

    }

    public static function actionCommentMovie($id)
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
                    Сommentary::saveComment(Users::checkLogged(),$comment_head,$comment_text,'Movies',$id);
                    header('Location: /movies/id'.$id);
                }
            }
            require_once ROOT . '/views/movies/comment.php';
            return true;
        }

        header('Location: /error/401');
        return true;
    }
}