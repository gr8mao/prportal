<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 14.05.16
 * Time: 19:52
 */

return array(
    'login' => 'user/login',                // actionLogin в UserController
    'registration' => 'user/registration',  // actionRegistration в UserController

    'error/([0-9]+)' => 'error/execute/$1', // actionExecution в ErrorController


    'events' => 'events/index',             // actionIndex в EventsController


    'movies' => 'movies/index',             // actionIndex в MoviesController


    'books' => 'books/index',               // actionIndex в BooksController


    'articles/submit' => 'article/submit',  // actionSubmit в ArticleController
    'articles' => 'article/index',          //actionIndex в ArticleController


    'about' => 'home/about',                // actionAbout в HomeController
    '' => 'home/index'                      // actionIndex в HomeController
);