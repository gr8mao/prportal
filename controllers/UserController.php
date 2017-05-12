<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 06.06.16
 * Time: 17:09
 */
class UserController
{
    public function actionLogin()
    {
        if (Users::isGuest()) {
            // Переменные для формы
            $errors = [];

            // Обработка формы
            if (isset($_POST['submit'])) {
                // Если форма отправлена
                // Получаем данные из формы
                $email = $_POST['email'];
                $password = $_POST['password'];
                // Валидация полей
                if (!Users::checkEmail($email)) {
                    $errors[] = 'Неправильный email';
                }
                if (!Users::checkPassword($password)) {
                    $errors[] = 'Пароль не должен быть короче 6-ти символов';
                }
                // Проверяем существует ли пользователь
                $userId = Users::checkUserData($email, $password);
                if ($userId == false) {
                    // Если данные неправильные - показываем ошибку
                    $errors[] = 'Неправильные данные для входа на сайт';
                } else if ($userId == 'not approved') {
                    $errors[] = 'Пользователь не подтвержден';
                } else {
                    // Если данные правильные, запоминаем пользователя (сессия)
                    Users::auth($userId);
                    // Перенаправляем пользователя в закрытую часть - кабинет
                    header("Location: /cabinet");
                }
            }
            // Подключаем вид
            require_once(ROOT . '/views/users/login.php');
            return true;
        } else {
            header('Location: /');
            return true;
        }

    }

    public function actionRegistration()
    {

        $sent = false;
        $errors = false;

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $re_password = $_POST['re_password'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $group_name = $_POST['group_name'];

            if ($first_name == '' || $last_name == '' || $group_name == '') {
                $errors[] = 'Заполните все поля!';
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Неверный формат электронной почты';
            }

            if (Users::checkEmailExist($email)) {
                $errors[] = 'Такой адрес уже зарезирвирован';
            }

            if (strlen($password) < 6) {
                $errors[] = 'Пароль должен содержать не менее 6 симоволов';
            }

            if ($password !== $re_password) {
                $errors[] = 'Введеные пароли не совпадают';
            }

            if (!$errors) {
                $result = Users::registerUser($email, $password, $first_name, $last_name, $group_name);

                if ($result) {
                    $sent = 'Вам на почту отправлено пиьсмо для подтверждения регистрации';
                } else {
                    header('Location: /error/500');
                }
            }
        }

        include_once ROOT . '/views/users/registation.php';
        return true;
    }

    public function actionLogout()
    {
        // Удаляем информацию о пользователе из сессии
        unset($_SESSION["user"]);

        // Перенаправляем пользователя на главную страницу
        header("Location: /");
        return true;
    }

    public function actionCabinet()
    {

        if (!Users::isGuest()) {

            $userInfo = Users::getUserById(Users::checkLogged());
            $MaterialCount = Users::getMaterialCountById(Users::checkLogged());

            $user_image = '';
            $errors = [];

            if (isset($_POST['submit'])) {
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
                            $size = GetImageSize($filename);
                            if ($size[0] == $size[1]) {
                                if (!file_exists(ROOT . "/img/users/id" . Users::checkLogged())) {
                                    mkdir(ROOT . "/img/users/id" . Users::checkLogged());
                                }
                                if (move_uploaded_file($filename, ROOT . '/img/users/id' . Users::checkLogged() . '/' . $_FILES['file']['name'])) {
                                    $user_image = '/img/users/id' . Users::checkLogged() . '/' . $_FILES['file']['name'];
                                } else {
                                    $errors[] = 'Ошибка сервера: Ошибка переноса файла! Попробуйте позже!';
                                }
                            } else {
                                $errors[] = 'Только квадратные фотографии';
                            }
                        }
                    } else {
                        $errors[] = "Файл не может быть пустым!";
                    }
                }

                if ($errors == false) {
                    Users::editProfilePhoto(Users::checkLogged(), $user_image);
                    header("Location: /cabinet");
                }
            }

            require_once(ROOT . '/views/cabinet/profile.php');
            return true;
        } else {
            header("Location: /error/401");
        }
        return true;
    }

    public static function actionUserMovies()
    {
        if (!Users::isGuest()) {
            $userInfo = Users::getUserById(Users::checkLogged());
            $movies = Movies::getMoviesByUserId(Users::checkLogged());

            require_once(ROOT . '/views/cabinet/user_movie_view.php');
            return true;
        } else {
            header("Location: /error/401");
        }
        return true;
    }

    public static function actionUserBooks()
    {
        if (!Users::isGuest()) {
            $userInfo = Users::getUserById(Users::checkLogged());
            $books = Books::getBooksByUserId(Users::checkLogged());

            require_once(ROOT . '/views/cabinet/user_book_view.php');
            return true;
        } else {
            header("Location: /error/401");
        }
        return true;
    }

    public static function actionUserEvents()
    {
        if (!Users::isGuest()) {
            $userInfo = Users::getUserById(Users::checkLogged());
            $events = Events::getEventsByUserId(Users::checkLogged());
            $currentMonth = 0;

            require_once(ROOT . '/views/cabinet/user_event_view.php');
            return true;
        } else {
            header("Location: /error/401");
        }
        return true;
    }

    public static function actionUserArticles()
    {
        if (!Users::isGuest()) {
            $userInfo = Users::getUserById(Users::checkLogged());
            $articles = Article::getArticlesByUserId(Users::checkLogged());

            require_once(ROOT . '/views/cabinet/user_article_view.php');
            return true;
        } else {
            header("Location: /error/401");
        }
        return true;
    }

    public static function actionEditUser()
    {
        if (!Users::isGuest()) {
            $userInfo = Users::getUserById(Users::checkLogged());

            $errors = false;

            if (isset($_POST['submit'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $re_password = $_POST['re_password'];
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $group_name = $_POST['group_name'];

                if (($first_name and $first_name == '') or ($last_name and $last_name == '') or ($group_name and $group_name == '')) {
                    $errors[] = 'Заполните все поля!';
                }

                if ($email and !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = 'Неверный формат электронной почты';
                }

                if ($password) {
                    if (strlen($password) < 6) {
                        $errors[] = 'Пароль должен содержать не менее 6 симоволов';
                    }

                    if ($password !== $re_password) {
                        $errors[] = 'Введеные пароли не совпадают';
                    }
                }


                if (!$errors) {
                    $result = Users::editProfileInfo(Users::checkLogged(), $email, $password, $first_name, $last_name, $group_name);

                    if ($result) {
                        header('Location: /cabinet');
                    } else {
                        header('Location: /error/500');
                    }
                }
            }

            include_once ROOT . '/views/users/edit.php';
            return true;
        } else {
            header("Location: /error/401");
        }
        return true;
    }

    public static function actionVerifyUser($id,$key){

        if(Users::verifyKey($id,$key)){
            header('Location: /login');
        } else {
            header('Location: /error/403');
        }
        return true;
    }
}