<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 06.05.17
 * Time: 17:13
 */

$title = 'Панель администратора | PR-портал';
include_once ROOT . '/templates/header.php'; ?>


    <!-- login-bloc -->
    <div class="bloc l-bloc bgc-white " id="login-bloc">
        <div class="container bloc-lg" style="padding-top: 20px;">
            <div class="row">
                <h1 class="mg-md text-center">
                    Панель администратора
                </h1>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mg-md text-center">
                        Новые пользователи
                    </h3>
                    <? if ($userList): ?>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th style="text-align: center">ID</th>
                                <th style="text-align: center">Email</th>
                                <th style="text-align: center">Имя</th>
                                <th style="text-align: center">Группа</th>
                                <th style="text-align: center">Подтвердить</th>
                            </tr>
                            </thead>
                            <tbody>
                            <? foreach ($userList as $user): ?>
                                <tr <? if (!$user['Approved']): ?>class="warning"<? endif; ?>
                                    style="text-align: center; vertical-align: baseline;">
                                    <th scope="row"><? echo $user['id']; ?></th>
                                    <td><? echo $user['Email']; ?></td>
                                    <td><? echo $user['First_name'] . ' ' . $user['Last_name']; ?></td>
                                    <td><? echo $user['Group_name']; ?></td>
                                    <td style="text-align: center; vertical-align: top;">
                                        <a href="/admin/users/approve<? echo $user['id']; ?>" type="button"
                                           class="btn btn-sm btn-success"><span
                                                class="glyphicon glyphicon-check"></span></a>
                                    </td>
                                </tr>
                            <? endforeach; ?>
                            </tbody>
                        </table>
                    <? else: ?>
                        <h3 class="mg-md text-center">
                            Нет пользователей
                        </h3>
                    <? endif; ?>
                    <a href="/admin/users/approveAll" class="btn btn-lg center-block btn-default">
                        Подтвердить всех</a>
                    <a href="/admin/users" class="btn btn-lg center-block btn-default">
                        Все пользователи</a>
                </div>
                <div class="col-sm-6">
                    <h3 class="mg-md text-center">
                        Материалы
                    </h3>
                    <div class="row">
                        <div class="col-sm-4">
                            <a href="/admin/books" class="btn btn-lg center-block btn-default">
                                Все книги</a>
                        </div>
                        <div class="col-sm-4">
                            <a href="/admin/movies" class="btn btn-lg center-block btn-default">
                                Все фильмы</a>
                        </div>
                        <div class="col-sm-4">
                            <a href="/admin/articles" class="btn btn-lg center-block btn-default">
                                Все статьи</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="/admin/events" class="btn btn-lg center-block btn-default">
                                Все события</a>
                        </div>
                        <div class="col-sm-6">
                            <a href="/admin/news" class="btn btn-lg center-block btn-default">
                                Все новости</a>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 30px;">
                        <h3 class="mg-md text-center">
                            Добавить материалы
                        </h3>
                        <div class="col-sm-6">
                            <a href="/books/submit" class="btn btn-lg center-block btn-default">
                                <span class="feather-icon icon-plus icon-spacer"></span>Добавить книгу</a>
                        </div>
                        <div class="col-sm-6">
                            <a href="/movies/submit" class="btn btn-lg center-block btn-default">
                                <span class="feather-icon icon-plus icon-spacer"></span>Добавить фильм</a>
                        </div>
                        <div class="col-sm-6">
                            <a href="/articles/submit" class="btn btn-lg center-block btn-default">
                                <span class="feather-icon icon-plus icon-spacer"></span>Добавить статью</a>
                        </div>
                        <div class="col-sm-6">
                            <a href="/events/submit" class="btn btn-lg center-block btn-default">
                                <span class="feather-icon icon-plus icon-spacer"></span>Добавить событие</a>
                        </div>
                        <div class="col-sm-6">
                            <a href="/news/submit" class="btn btn-lg center-block btn-default">
                                <span class="feather-icon icon-plus icon-spacer"></span>Добавить новость</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- login-bloc END -->
<? include_once ROOT . '/templates/footer.php'; ?>