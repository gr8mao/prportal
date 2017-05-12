<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 06.05.17
 * Time: 23:45
 */

$title = 'Изменить новость | PR-портал';
include_once ROOT.'/templates/header.php'; ?>

<!-- bloc-24 -->
<div class="bloc b-parallax login-bloc tc-outer-space bgc-white hidden-xs" id="bloc-24" xmlns="http://www.w3.org/1999/html">
    <div class="container bloc-lg" style="padding-top: 20px;">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="mg-md tc-white">
                    <span class="feather-icon icon-outbox"></span> Изменить новость
                </h1>
            </div>
        </div>
        <div class="row" style="padding-top: 30px;">
            <div class="col-sm-12 col-md-6 col-md-offset-3">
                <div class="panel">
                    <div class="panel-body">
                        <form id="form" method="post" action="#" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="header">
                                    Заголовок новости
                                </label>
                                <input id="header" name="header" class="form-control" type="text" value="<?echo $news['Header'];?>"/>
                            </div>
                            <div class="form-group">
                                <label for="text">
                                    Текст новости
                                </label><textarea id="text" name="text" class="form-control" rows="4" cols="50" required><?echo $news['Text'];?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="radio-inline"><input type="radio" name="location" value="World" <?if($news['Location']=='World'):?>checked<?endif;?>>Мировая</label>
                                <label class="radio-inline"><input type="radio" name="location" value="Russia" <?if($news['Location']=='Russia'):?>checked<?endif;?>>Российская</label>
                            </div>
                            <div class="form-group">
                                <label for="file">
                                    Обложка
                                </label> <input id="file" name="file" class="form-control" type="file"/>
                            </div>
                            <input class="btn btn-d btn-lg btn-block" type="submit"  name="submit" id="submit" value="Отправить"/>
                        </form>
                        <?if($errors):?>
                            <div class="form-alert">
                                <h4 class=" alert alert-danger">Найдены ошибки при заполнении!</h4>
                                <ul type="none" class="alert alert-danger">
                                    <?foreach($errors as $error):?>
                                        <li class="alert-danger"><?echo $error?></li>
                                    <?endforeach;?>
                                </ul>
                            </div>
                        <?endif;?>
                        <?if($errors === false):?>
                            <div class="form-alert">
                                <h4 class=" alert alert-success">Ваша статья успешно добавлена в базу!</h4>
                            </div>
                        <?endif;?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- bloc-24 END -->

<? include_once ROOT . '/templates/footer.php'; ?>
