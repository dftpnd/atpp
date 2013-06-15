<div class="raspisanie" >
    <h1>
        <?php
        echo 'Курс ' . $kurs . ' cеместр ' . $semestr;
        ?>
    </h1>
    <div id="breadcrambs">
        <?php
        $this->widget('zii.widgets.CBreadcrumbs', array(
            'links' => array(
                'Моё расписание'
            ),
            'separator' => '<span> / <span>'
        ));
        ?>
    </div>
    <?php
    if ($profile->leader == 1) {
        echo CHtml::link(
                'Редактировать', Yii::app()->urlManager->createUrl(
                        '/user/editschedule'
                ), array('class' => 'create_schedule')
        );
    }
    ?>

</div>

<?php
$this->renderPartial('application.views.user.new_schedule', array(
    'wekdays' => $wekdays,
    'data' => $data,
    'data2' => $data2,
    'data3' => $data3,
    'type_pair' => $type_pair,
    'time_pair' => $time_pair,
    'we' => $we,
    'semestr' => $semestr
        )
)
?>


