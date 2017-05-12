<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <link rel="shortcut icon" type="image/png" href="/favicon.png" />
    <title><?echo $title;?></title>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/style.css">
    <link rel="stylesheet" href="/css/animate.min.css" />
    <link rel='stylesheet' href='/css/font-awesome.min.css'/>
    <link rel='stylesheet' href='/css/feather.min.css'/>
    <link rel='stylesheet' href='/css/datepicker.css'/>

    <script src="/js/jquery-2.1.0.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/blocs.min.js"></script>
    <script src="/js/moment.js"></script>
    <script src="/js/datepicker.js"></script>

</head>
<body>
<!-- Main container -->
<div class="page-container">

    <!-- top -->
    <div class="bloc sticky-nav bgc-white l-bloc" id="top">
        <div class="container">
            <nav class="navbar row">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/" id="logo-top"><img src="/img/pr_horiz.svg" alt="logo" height="50" /></a>
                    <button id="nav-toggle" type="button" class="ui-navbar-toggle navbar-toggle" data-toggle="collapse" data-target=".navbar-1">
                        <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse navbar-1 collapse">
                    <ul class="site-navigation nav navbar-nav list-sp-md list-unstyled" id="menu">
                        <li>
                            <a href="/">Главная</a>
                        </li>
                        <li>
                            <a href="/news">Новости</a>
                        </li>
                        <li>
                            <a href="/events">События</a>
                        </li>
                        <li>
                            <a href="/movies">Фильмы</a>
                        </li>
                        <li>
                            <a href="/books">Книги</a>
                        </li>
                        <li>
                            <a href="/articles">Статьи</a>
                        </li>
                        <?if(!Users::isGuest()){?>
                        <li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Аккаунт <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/cabinet">Войти в кабинет</a></li>
                                    <li><a href="/logout">Выйти из аккаунта</a></li>
                                </ul>
                            </li>
                        </li>
                        <?} else {?>
                            <li>
                                <a href="/login">Вход</a>
                            </li>
                        <? } ?>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!-- top END -->