<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 06.05.17
 * Time: 23:45
 */

$title = 'Все книги | PR-портал';
include_once ROOT . '/templates/header.php'; ?>


    <!-- login-bloc -->
    <div class="bloc l-bloc bgc-white " id="login-bloc">
        <div class="container bloc-lg" style="padding-top: 20px;">
            <div class="row">
                <h1 class="mg-md text-center">
                    Книги
                </h1>
            </div>
            <div class="row">
                <div class="col-sm-offset-8 col-sm-2">
                    <a href="/admin/books/approveAll" type="button"
                       class="btn btn-success center-block"><span
                            class="glyphicon glyphicon-check"></span> Подтвердить все</a>
                </div>
                <div class="col-sm-2">
                    <a href="/admin" type="button"
                       class="btn btn-default center-block"> Назад</a>
                </div>
                <div class="col-sm-12">
                    <? if ($booksList): ?>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th style="text-align: center">ID</th>
                                <th style="text-align: center">Название</th>
                                <th style="text-align: center">Автор</th>
                                <th style="text-align: center">Добавлен</th>
                                <th style="text-align: center">Ссылка</th>
                                <th style="text-align: center">Подвердить</th>
                                <th style="text-align: center">Изменить</th>
                                <th style="text-align: center">Удалить</th>
                            </tr>
                            </thead>
                            <tbody>
                            <? foreach ($booksList as $books): ?>
                                <tr <? if (!$books['Approved']): ?>class="warning"<? endif; ?>
                                    style="text-align: center; vertical-align: baseline;">
                                    <th scope="row"><? echo $books['id']; ?></th>
                                    <td><? echo $books['Title']; ?></td>
                                    <td><? echo $books['Author']; ?></td>
                                    <td><? echo Users::getUsernameById($books['Added_By']); ?></td>
                                    <td><a href="/admin/books/show<? echo $books['id']; ?>">Ссылка</a></td>
                                    <td style="text-align: center; vertical-align: top;">
                                        <a href="/admin/books/approve<? echo $books['id']; ?>" type="button"
                                           class="btn btn-sm btn-success"><span
                                                class="glyphicon glyphicon-check"></span></a>
                                    </td>
                                    <td style="text-align: center; vertical-align: top;">
                                        <a href="/admin/books/edit<? echo $books['id']; ?>" type="button"
                                           class="btn btn-sm btn-info"><span
                                                class="glyphicon glyphicon-edit"></span></a>
                                    </td>
                                    <td style="text-align: center; vertical-align: top;">
                                        <a href="/admin/books/delete<? echo $books['id']; ?>" type="button"
                                           class="btn btn-sm btn-danger"><span
                                                class="glyphicon glyphicon-trash"></span></a>
                                    </td>
                                </tr>
                            <? endforeach; ?>
                            </tbody>
                        </table>
                        <? if ($pagination): ?>
                            <? echo $pagination->get(); ?>
                        <? endif; ?>
                    <? else: ?>
                        <h3 class="mg-md text-center">
                            Нет новостей...
                        </h3>
                    <? endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- login-bloc END -->
<? include_once ROOT . '/templates/footer.php'; ?>