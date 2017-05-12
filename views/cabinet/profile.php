<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 03.05.17
 * Time: 23:55
 */
$title = 'Профиль | PR-портал';
include_once ROOT . '/templates/header.php'; ?>


    <!-- login-bloc -->
    <div class="bloc l-bloc bgc-white " id="login-bloc">
        <div class="container bloc-lg">
            <div class="row">
                <div class="col-sm-4">
                    <h3 class="mg-md">
                        <a href="/cabinet/events"><span class="feather-icon icon-map"></span> Мои события</a>
                    </h3>
                    <h3 class="mg-md">
                        <a href="/cabinet/movies"> <span class="feather-icon icon-video"></span> Мои фильмы</a>
                    </h3>
                    <h3 class="mg-md">
                        <a href="/cabinet/books"><span class="feather-icon icon-book"></span> Мои книги</a>
                    </h3>
                    <h3 class="mg-md">
                        <a href="/cabinet/articles"><span class="feather-icon icon-paragraph"></span> Мои статьи</a>
                    </h3>
                </div>
                <div class="col-sm-5" style="text-align: right;">
                    <h1 class="mg-md">
                        <strong><? echo $userInfo['First_name'] . ' ' . $userInfo['Last_name'] ?></strong>
                    </h1>
                    <h4>
                        <strong>Учебная группа:</strong> <? echo $userInfo['Group_name']; ?><br/><strong>Всего
                            добавленных материалов:</strong> <? echo $MaterialCount ?>
                    </h4>
                </div>
                <div class="col-sm-3">
                    <img src="<? echo $userInfo['Image'] ?>" class="img-responsive img-circle hidden-xs"/>
                    <a href="/cabinet/edit" class="btn  btn-d  btn-sm hidden-xs bt"
                       style="text-align: center; display: block; margin: 20px auto 0;">Редактировать профиль</a>
                    <a data-toggle="modal" data-target="#myModal" class="btn  btn-d  btn-sm hidden-xs bt"
                       style="text-align: center; display: block; margin: 5px auto;">Изменить фотографию</a>
                    <a href="/logout" class="btn  btn-d  btn-sm hidden-xs bt"
                       style="text-align: center; display: block; margin: 5px auto;">Выйти</a>
                </div>
            </div>
            <!--
              <div class="row voffset">
                  <div class="col-sm-3">
                      <h3 class="mg-md">
                          <a href="/cabinet/events"><span class="feather-icon icon-map"></span> Мои события</a>
                      </h3>
                      <h3 class="mg-md">
                          <a href="/cabinet/movies"> <span class="feather-icon icon-video"></span> Мои фильмы</a>
                      </h3>
                      <h3 class="mg-md">
                          <a href="/cabinet/books"><span class="feather-icon icon-book"></span> Мои книги</a>
                      </h3>
                      <h3 class="mg-md">
                          <a href="/cabinet/articles"><span class="feather-icon icon-paragraph"></span> Мои статьи</a>
                      </h3>
                  </div>
                  <div class="col-sm-9">
                      <div class="panel">
                          <div class="panel-heading">
                              <h3 class="mg-clear">
                                  Заголовок
                              </h3>
                              <div class="btn-group btn-dropdown pull-right">
                                  <a href="#" class="btn dropdown-toggle  btn-d  btn-lg" data-toggle="dropdown" aria-expanded="false">Опции<span class="caret"></span></a>
                                  <ul class="dropdown-menu" role="menu">
                                      <li>
                                          <a href="index.html" class="a-btn a-block">Изменить</a>
                                      </li>
                                      <li>
                                          <a href="index.html" class="a-btn a-block">Удалить</a>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                          <div class="panel-body">
                              <p>
                                  Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                              </p>
                          </div>
                      </div>
                      <div class="panel">
                          <div class="panel-heading">
                              <h3 class="mg-clear">
                                  Заголовок
                              </h3>
                              <div class="btn-group btn-dropdown pull-right">
                                  <a href="#" class="btn dropdown-toggle  btn-d  btn-lg" data-toggle="dropdown" aria-expanded="true">Опции<span class="caret"></span></a>
                                  <ul class="dropdown-menu" role="menu">
                                      <li>
                                          <a href="index.html" class="a-btn a-block">Изменить</a>
                                      </li>
                                      <li>
                                          <a href="index.html" class="a-btn a-block">Удалить</a>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                          <div class="panel-body">
                              <p>
                                  Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
              -->
        </div>
    </div>
    <!-- login-bloc END -->

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Изменение фотографии профиля</h4>
                </div>
                <div class="modal-body">
                    <form id="form" method="post" action="#" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="file">
                                Фотография
                            </label> <input id="file" name="file" class="form-control" type="file"/>
                        </div>
                        <input class="btn btn-d btn-lg btn-block" type="submit" name="submit" id="submit"
                               value="Изменить"/>
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
                            <h4 class=" alert alert-success">Фотография изменена!</h4>
                        </div>
                    <? endif; ?>
                </div>
            </div>
        </div>
    </div>
<? include_once ROOT . '/templates/footer.php'; ?>