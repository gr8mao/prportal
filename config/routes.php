<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 14.05.16
 * Time: 19:52
 */

return array(
    'login' => 'user/login',                  // actionLogin в UserController
    'logout' => 'user/logout',                // actionLogin в UserController
    'registration' => 'user/registration',    // actionRegistration в UserController
    'verifyuser([0-9]+)/([\w\W]+)' => 'user/verifyUser/$1/$2',    // actionRegistration в UserController
    'deleteComment([0-9]+)/([a-zA-Z]+)/([0-9]+)' => 'admin/deleteComment/$1/$2/$3',    // actionRegistration в UserController


    'admin' => 'admin/index',
    'admin/users' => 'admin/showUsers',
    'admin/users/setadmin([0-9]+)' => 'admin/setAdmin/$1',
    'admin/users/setuser([0-9]+)' => 'admin/setUser/$1',
    'admin/users/page-([0-9]+)' => 'admin/showUsers/$1',
    'admin/users/edit([0-9]+)' => 'admin/editUser/$1',
    'admin/users/delete([0-9]+)' => 'admin/deleteUser/$1',
    'admin/users/approve([0-9]+)' => 'admin/approveUser/$1',
    'admin/users/approveAll' => 'admin/approveAllUsers',

    'admin/articles' => 'admin/showAllArticles',
    'admin/articles/page-([0-9]+)' => 'admin/showAllArticles/$1',
    'admin/articles/show([0-9]+)' => 'admin/showArticle/$1',
    'admin/articles/edit([0-9]+)' => 'admin/editArticle/$1',
    'admin/articles/delete([0-9]+)' => 'admin/deleteArticle/$1',
    'admin/articles/approve([0-9]+)' => 'admin/approveArticle/$1',
    'admin/articles/approveAll' => 'admin/approveAllArticles',

    'admin/movies' => 'admin/showAllMovies',
    'admin/movies/page-([0-9]+)' => 'admin/showAllMovies/$1',
    'admin/movies/show([0-9]+)' => 'admin/showMovie/$1',
    'admin/movies/edit([0-9]+)' => 'admin/editMovie/$1',
    'admin/movies/delete([0-9]+)' => 'admin/deleteMovie/$1',
    'admin/movies/approve([0-9]+)' => 'admin/approveMovie/$1',
    'admin/movies/approveAll' => 'admin/approveAllMovies',

    'admin/books' => 'admin/showAllBooks',
    'admin/books/page-([0-9]+)' => 'admin/showAllBooks/$1',
    'admin/books/show([0-9]+)' => 'admin/showBook/$1',
    'admin/books/edit([0-9]+)' => 'admin/editBook/$1',
    'admin/books/delete([0-9]+)' => 'admin/deleteBook/$1',
    'admin/books/approve([0-9]+)' => 'admin/approveBook/$1',
    'admin/books/approveAll' => 'admin/approveAllBooks',

    'admin/events' => 'admin/showAllEvents',
    'admin/events/page-([0-9]+)' => 'admin/showAllEvents/$1',
    'admin/events/show([0-9]+)' => 'admin/showEvent/$1',
    'admin/events/edit([0-9]+)' => 'admin/editEvent/$1',
    'admin/events/delete([0-9]+)' => 'admin/deleteEvent/$1',
    'admin/events/approve([0-9]+)' => 'admin/approveEvent/$1',
    'admin/events/approveAll' => 'admin/approveAllEvents',

    'admin/news' => 'admin/showAllNews',
    'admin/news/page-([0-9]+)' => 'admin/showAllNews/$1',
    'admin/news/show([0-9]+)' => 'admin/showNews/$1',
    'admin/news/edit([0-9]+)' => 'admin/editNews/$1',
    'admin/news/delete([0-9]+)' => 'admin/deleteNews/$1',
    'admin/news/approve([0-9]+)' => 'admin/approveNews/$1',
    'admin/news/approveAll' => 'admin/approveAllNews',


    'cabinet' => 'user/cabinet',                     // actionCabinet в UserController
    'cabinet/movies' => 'user/userMovies',           // actionUserMovies в UserController
    'cabinet/books' => 'user/userBooks',             // actionUserBooks в UserController
    'cabinet/events' => 'user/userEvents',           // actionUserEvents в UserController
    'cabinet/articles' => 'user/userArticles',       // actionUserArticles в UserController
    'cabinet/edit' => 'user/editUser',               // actionEditUser в UserController


    'error/([0-9]+)' => 'error/execute/$1',    // actionExecution в ErrorController


    'events/submit' => 'events/submit',                     // actionSubmit в EventsController
    'events/comment([0-9]+)' => 'events/commentEvent/$1',   // actionCommentEvent в EventsController
    'events/id([0-9]+)' => 'events/aboutEvent/$1',          // actionAboutEvent в EventsController
    'events' => 'events/index',                             // actionIndex в EventsController


    'news/submit' => 'news/submit',
    'news' => 'news/index',


    'movies/id([0-9]+)' => 'movies/aboutMovie/$1',
    'movies/comment([0-9]+)' => 'movies/commentMovie/$1',
    'movies/submit' => 'movies/submit',
    'movies' => 'movies/index',             // actionIndex в MoviesController


    'books/id([0-9]+)' => 'books/aboutBook/$1',
    'books/comment([0-9]+)' => 'books/commentBook/$1',
    'books/submit' => 'books/submit',
    'books' => 'books/index',               // actionIndex в BooksController


    'articles/submit' => 'article/submit',  // actionSubmit в ArticleController
    'articles' => 'article/index',          //actionIndex в ArticleController


//    'about' => 'home/about',                // actionAbout в HomeController
    '' => 'home/index'                      // actionIndex в HomeController
);