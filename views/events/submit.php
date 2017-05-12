<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 06.05.17
 * Time: 11:40
 */

$title = 'Добавить событие | PR-портал';
include_once ROOT . '/templates/header.php'; ?>

    <!-- bloc-24 -->
    <div class="bloc b-parallax login-bloc tc-outer-space bgc-white hidden-xs" id="bloc-24"
         xmlns="http://www.w3.org/1999/html">
        <div class="container bloc-lg" style="padding-top: 20px;">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="mg-md tc-white">
                        <span class="feather-icon icon-outbox"></span> Добавить событие
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-md-offset-3">
                    <div class="panel">
                        <div class="panel-body">
                            <form id="form" method="post" action="#" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">
                                        Название мероприятия
                                    </label>
                                    <input id="name" name="name" class="form-control" type="text"/>
                                </div>
                                <div class="form-group">
                                    <label for="place">
                                        Место проведения
                                    </label>
                                    <input id="place" name="place" class="form-control" type="text"/>
                                </div>
                                <div class="form-group">
                                    <label for="link">
                                        Ссылка на сайт мероприятия
                                    </label>
                                    <input id="link" name="link" class="form-control" type="text"/>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="Date_start">
                                            Дата начала мероприятия
                                        </label>
                                        <div class='input-group date' id='datetimepicker1'>
                                            <input type='text' class="form-control" name="Date_start" id="Date_start"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        </div>
                                        <script type="text/javascript">
                                            $(function () {
                                                $('#datetimepicker1').datetimepicker({
                                                    icons: {
                                                        date: "glyphicon glyphicon-calendar",
                                                        up: "glyphicon glyphicon-chevron-left",
                                                        down: "glyphicon glyphicon-chevron-right"
                                                    },
                                                    locale: 'ru',
                                                    format: 'YYYY-MM-DD'
                                                });
                                            });
                                            $("#datetimepicker1").on("dp.change", function (e) {
                                                $('#datetimepicker1').data("DateTimePicker").minDate(e.date);
                                                $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
                                            });
                                        </script>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="Date_end">
                                            Дата конца мероприятия
                                        </label>
                                        <div class='input-group date' id='datetimepicker2'>
                                            <input type='text' class="form-control" name="Date_end" id="Date_end"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        </div>
                                        <script type="text/javascript">
                                            $(function () {
                                                $('#datetimepicker2').datetimepicker({
                                                    icons: {
                                                        date: "glyphicon glyphicon-calendar",
                                                        up: "glyphicon glyphicon-chevron-left",
                                                        down: "glyphicon glyphicon-chevron-right"
                                                    },
                                                    locale: 'ru',
                                                    format: 'YYYY-MM-DD',
                                                    useCurrent: false //Important! See issue #1075
                                                }).show().on("dp.change", function (e) {
                                                    $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                                <div class="form-group" style="padding-top: 10px;">
                                    <label for="content">
                                        Аннотация мероприятия
                                    </label><textarea id="content" name="annotation" class="form-control" rows="4"
                                                      cols="50" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="file">
                                        Обложка
                                    </label> <input id="file" name="file" class="form-control" type="file"/>
                                </div>
                                <input class="btn btn-d btn-lg btn-block" type="submit" name="submit" id="submit" value="Отправить"/>
                            </form>
                            <? if ($errors): ?>
                                <div class="form-alert">
                                    <h4 class=" alert alert-danger">Найдены ошибки при заполнении!</h4>
                                    <ul type="none" class="alert alert-danger">
                                        <? foreach ($errors as $error): ?>
                                            <li class="alert-danger"><? echo $error ?></li>
                                        <? endforeach; ?>
                                    </ul>
                                </div>
                            <? endif; ?>
                            <? if ($errors === false): ?>
                                <div class="form-alert">
                                    <h4 class=" alert alert-success">Ваша статья успешно добавлена в базу!</h4>
                                </div>
                            <? endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bloc-24 END -->

<? include_once ROOT . '/templates/footer.php'; ?>