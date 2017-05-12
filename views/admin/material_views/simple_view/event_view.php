<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 06.05.17
 * Time: 23:45
 */

$title = 'Мероприятие | PR-портал';
include_once ROOT.'/templates/header.php';?>

<!-- bloc-21 -->
<div class="bloc bgc-white l-bloc" id="bloc-21">
    <div class="container bloc-md">
        <div class="row voffset">
            <div class="col-sm-4">
                <img src="<?echo $event['Image'];?>" class="img-responsive" />
                <h4 class="mg-md">
                    <span class="feather-icon icon-bell"></span> <?echo $event['Date_start']; if(isset($event['Date_end'])){ echo ' - '.$event['Date_end'];};?>
                </h4>
                <h4 class="mg-md">
                    <span class="feather-icon icon-map"></span> <?echo $event['Place'];?>
                </h4>
            </div>
            <div class="col-sm-8">
                <h6 class="text-right mg-clear">
                    <span class="feather-icon icon-square-check"></span> <strong>Добавлено: <?echo $added_by;?></strong>
                </h6>
                <h1 class="mg-md">
                    <strong><?echo $event['Name'];?></strong><br>
                </h1>
                <p class="mg-lg">
                    <?echo $event['Annotation'];?>
                </p>
                <?if($event['Link'])?>
                <div class="text-center">
                    <a href="<?echo $event['Link'];?>" class="btn  btn-d  btn-xl" target="_blank"><span class="feather-icon icon-link icon-spacer icon-white"></span>Подробности</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- bloc-21 END -->

<?include_once  ROOT.'/templates/footer.php';?>
