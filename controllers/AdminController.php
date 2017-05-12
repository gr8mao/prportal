<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 06.05.17
 * Time: 16:37
 */
class AdminController
{
    public static function actionIndex()
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {
            $userList = Users::getUsersList(1, 5);

            require_once ROOT . '/views/admin/index.php';
            return true;
        }
        return false;
    }

//    Пользователи ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    public static function actionShowUsers($page = 1)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            $total = Users::getUsersCount();

            $userList = Users::getUsersList($page);

            $pagination = '';
            if ($total > Users::SHOW_BY_DEFAULT) {
                $pagination = new Pagination(intval($total), $page, Users::SHOW_BY_DEFAULT, 'page-');
            }

            require_once ROOT . '/views/admin/users_views/all_users.php';
            return true;
        }
        return false;
    }

    public static function actionDeleteUser($id)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            if (Users::checkUserAdmin($id)) {
                header('Location: /admin/users');
                return true;
            }

            Users::deleteUser($id);
            header('Location: /admin/users');
            return true;
        }
        return false;
    }

    public static function actionSetAdmin($id)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            if (Users::checkUserAdmin($id)) {
                header('Location: /admin/users');
                return true;
            }

            Users::setAdmin($id);
            header('Location: /admin/users');
            return true;
        }
        return false;
    }

    public static function actionSetUser($id)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            if (!Users::checkUserAdmin($id)) {
                header('Location: /admin/users');
                return true;
            }

            Users::setUser($id);
            header('Location: /admin/users');
            return true;
        }
        return false;
    }

    public static function actionApproveUser($id)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            Users::approveUser($id);
            header('Location: /admin/users');
            return true;
        }
        return false;
    }

    public static function actionApproveAllUsers()
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            Users::approveAllUsers();
            if (isset($_GET['redirect'])) {
                header('Location: /' . $_GET['redirect']);
                return true;
            }
            header('Location: /admin/users');
            return true;
        }
        return false;
    }

    public static function actionEditUser($id)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            $userInfo = Users::getUserById($id);

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
                    $result = Users::editProfileInfo($id, $email, $password, $first_name, $last_name, $group_name);

                    if ($result) {
                        header('Location: /admin/users');
                    } else {
                        header('Location: /error/500');
                    }
                }
            }

            include_once ROOT . '/views/users/edit.php';
            return true;
        }
        return false;
    }

//    Статьи ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    public static function actionShowAllArticles($page = 1)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            $total = Article::getArticlesCount();

            $articleList = Article::getArticles($page);

            $pagination = '';
            if ($total > Article::SHOW_BY_DEFAULT) {
                $pagination = new Pagination(intval($total), $page, Users::SHOW_BY_DEFAULT, 'page-');
            }

            require_once ROOT . '/views/admin/material_views/articles_view.php';
            return true;
        }
        return false;
    }

    public static function actionShowArticle($id)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {
            $article = Article::getArticleById($id);

            require_once ROOT . '/views/admin/material_views/simple_view/article_view.php';
            return true;
        }
        return false;
    }

    public static function actionEditArticle($id)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            $article = Article::getArticleById($id);
            $errors = [];

            if (isset($_POST['submit'])) {
                $article_title = $_POST['title'];
                $article_content = $_POST['content'];

                $errors = false;

                if ($article_title == '') {
                    $errors[] = 'Заголовое статьи не заполнен';
                }

                if ($article_content == '') {
                    $errors[] = 'Не заполнена статья';
                }

                if ($errors == false) {
                    Article::editArticle($id, $article_title, $article_content);
                    header('Location: /admin/articles');
                }
            }

            require_once ROOT . '/views/admin/material_views/edit_views/edit_article.php';
            return true;
        }

        return false;

    }

    public static function actionDeleteArticle($id)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            Article::deleteArticleById($id);
            header('Location: /admin/articles');
            return true;
        }
        return false;
    }

    public static function actionApproveArticle($id)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            Article::approveArticleById($id);
            header('Location: /admin/articles');
            return true;
        }
        return false;
    }

    public static function actionApproveAllArticles()
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            Article::approveAllArticles();
            header('Location: /admin/articles');
            return true;
        }
        return false;
    }

//    Книги ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    public static function actionShowAllBooks($page = 1)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {
            $total = Books::getBooksCount();

            $booksList = Books::getBooks($page);

            $pagination = '';
            if ($total > Books::SHOW_BY_DEFAULT) {
                $pagination = new Pagination(intval($total), $page, Users::SHOW_BY_DEFAULT, 'page-');
            }

            require_once ROOT . '/views/admin/material_views/books_view.php';
            return true;
        }
        return false;
    }

    public static function actionShowBook($id)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {
            $book = Books::getBookByID($id);
            if ($book) {
                $Added_By = Users::getUsernameById($book['Added_By']);

                require_once ROOT . '/views/admin/material_views/simple_view/book_view.php';
                return true;
            } else {
                header('Location: /error/404');
                return true;
            }
        }
        return false;
    }

    public static function actionEditBook($id)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            $book = Books::getBookByID($id);
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
                    $errors[] = 'Введите кооректную ссылку';
                }

                $max_image_size = 1024 * 10 * 1024;
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
                            if (move_uploaded_file($filename, ROOT . '/img/books/' . $_FILES['file']['name'])) {
                                $book_image = '/img/books/' . $_FILES['file']['name'];
                            } else {
                                $errors[] = 'Ошибка сервера: Ошибка переноса файла! Попробуйте позже!';
                            }
                        }
                    } else {
                        $book_image = $book['img'];
                    }
                }

                if ($errors == false) {
                    Books::editBook($id, $book_name, $book_author, $book_annotation, $book_image, $book_genre, $book_year, $book_link);
                    header('Location: /admin/books');
                }
            }

            require_once ROOT . '/views/admin/material_views/edit_views/edit_book.php';
            return true;
        }
        return false;
    }

    public static function actionDeleteBook($id)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            Books::deleteBookById($id);
            header('Location: /admin/books');
            return true;
        }
        return false;
    }

    public static function actionApproveBook($id)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            Books::approveBookById($id);
            header('Location: /admin/books');
            return true;
        }
        return false;
    }

    public static function actionApproveAllBooks()
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            Books::approveAllBooks();
            header('Location: /admin/books');
            return true;
        }
        return false;
    }

//    Фильмы ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    public static function actionShowAllMovies($page = 1)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {
            $total = Movies::getMoviesCount();

            $moviesList = Movies::getMovies($page);

            $pagination = '';
            if ($total > Movies::SHOW_BY_DEFAULT) {
                $pagination = new Pagination(intval($total), $page, Movies::SHOW_BY_DEFAULT, 'page-');
            }

            require_once ROOT . '/views/admin/material_views/movies_view.php';
            return true;
        }
        return false;
    }

    public static function actionShowMovie($id)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {
            $movie = Movies::getMovieByID($id);
            if ($movie) {
                $Added_By = Users::getUsernameById($movie['Added_By']);

                require_once ROOT . '/views/admin/material_views/simple_view/movie_view.php';
                return true;
            } else {
                header('Location: /error/404');
                return true;
            }
        }
        return false;
    }

    public static function actionEditMovie($id)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {
            $movie = Movies::getMovieByID($id);
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

                if (!filter_var($movie_link, FILTER_VALIDATE_URL)) {
                    $errors[] = 'Введите корректную ссылку';
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
                            if (move_uploaded_file($filename, ROOT . '/img/movies/' . $_FILES['file']['name'])) {
                                $movie_image = '/img/movies/' . $_FILES['file']['name'];
                            } else {
                                $errors[] = 'Ошибка сервера: Ошибка переноса файла! Попробуйте позже!';
                            }
                        }
                    } else {
                        $movie_image = $movie['Image'];
                    }
                }

                if ($errors == false) {
                    Movies::editMovie($id, $movie_name, $movie_country, $movie_year, $movie_annotation, $movie_genre, $movie_image, $movie_link);
                    header('Location: /admin/movies');
                }
            }

            require_once ROOT . '/views/admin/material_views/edit_views/edit_movie.php';
            return true;
        }
        return false;
    }

    public static function actionDeleteMovie($id)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            Movies::deleteMovieById($id);
            header('Location: /admin/movies');
            return true;
        }
        return false;
    }

    public static function actionApproveMovie($id)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            Movies::approveMovieById($id);
            header('Location: /admin/movies');
            return true;
        }
        return false;
    }

    public static function actionApproveAllMovies()
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            Movies::approveAllMovies();
            header('Location: /admin/movies');
            return true;
        }
        return false;
    }

//    Новости ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    public static function actionShowAllNews($page = 1)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            $total = News::getNewsCount();

            $newsList = News::getNews($page);

            $pagination = '';
            if ($total > News::SHOW_BY_DEFAULT) {
                $pagination = new Pagination(intval($total), $page, News::SHOW_BY_DEFAULT, 'page-');
            }
            include_once ROOT . '/views/admin/material_views/news_view.php';
            return true;
        }
        return false;
    }

    public static function actionShowNews($id)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            $news = News::getNewsById($id);
            include_once ROOT . '/views/admin/material_views/simple_view/news_view.php';
            return true;
        }
        return false;
    }

    public static function actionEditNews($id)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {
            $news = News::getNewsById($id);
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

                $max_image_size = 1024 * 1024 * 1024;
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
                        $news_image = $news['Image'];
                    }
                }

                if ($errors == false) {
                    News::editNews($id, $news_header, $news_text, $news_location, $news_image);
                    header('Location: /admin/news');
                }
            }

            require_once ROOT . '/views/admin/material_views/edit_views/edit_news.php';
            return true;
        }
        return false;
    }

    public static function actionDeleteNews($id)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            News::deleteNewsById($id);
            header('Location: /admin/news');
            return true;
        }
        return false;
    }

    public static function actionApproveNews($id)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            News::approveNewsById($id);
            header('Location: /admin/news');
            return true;
        }
        return false;
    }

    public static function actionApproveAllNews()
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            News::approveAllNews();
            header('Location: /admin/news');
            return true;
        }
        return false;
    }

//    События ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    public static function actionShowAllEvents($page = 1)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {
            $total = Events::getEventsCount();

            $eventsList = Events::getEvents($page);

            $pagination = '';
            if ($total > Events::SHOW_BY_DEFAULT) {
                $pagination = new Pagination(intval($total), $page, Events::SHOW_BY_DEFAULT, 'page-');
            }

            require_once ROOT . '/views/admin/material_views/events_view.php';
            return true;
        }
        return false;
    }

    public static function actionShowEvent($id)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {
            $event = Events::getEventByID($id);
            if ($event) {
                $added_by = Users::getUsernameById($event['Added_By']);
                $Comments = Сommentary::getSectionCommentary('Event', $id);

                require_once ROOT . '/views/admin/material_views/simple_view/event_view.php';
                return true;
            }
        }
        return false;
    }

    public static function actionEditEvent($id)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {
            $event = Events::getEvent($id);
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
                            if (move_uploaded_file($filename, ROOT . '/img/events/' . $_FILES['file']['name'])) {
                                $event_image = '/img/events/' . $_FILES['file']['name'];
                            } else {
                                $errors[] = 'Ошибка сервера: Ошибка переноса файла! Попробуйте позже!';
                            }
                        }
                    } else {
                        $event_image = $event['Image'];
                    }
                }

                if (!filter_var($event_link, FILTER_VALIDATE_URL)) {
                    $errors[] = "Введите корректную ссылку";
                }

                if ($errors == false) {
                    Events::editEvent($id, $event_name, $event_date_start, $event_date_end, $event_annotation, $event_place, $event_link, $event_image);
                    header('Location: /admin/events');
                }
            }

            require_once ROOT . '/views/admin/material_views/edit_views/edit_event.php';
            return true;
        }
        return false;
    }

    public static function actionDeleteEvent($id)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            Events::deleteEventById($id);
            header('Location: /admin/events');
            return true;
        }
        return false;
    }

    public static function actionApproveEvent($id)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {
            Events::approveEventById($id);
            header('Location: /admin/events');
            return true;
        }
        return false;
    }

    public static function actionApproveAllEvents()
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            Events::approveAllEvents();
            header('Location: /admin/events');
            return true;
        }
        return false;
    }


//    Комментарии ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public static function actionDeleteComment($id, $redirect, $mId)
    {
        if (!Users::isGuest() and Users::checkUserAdmin(Users::checkLogged())) {

            $Comments = Сommentary::deleteComment($id);

            header('Location:' . '/' . $redirect . '/id' . $mId);
            return true;
        }
        return false;
    }
}