<?php
$class1 = '';
$class2 = '';
if (isset($_GET['topic'])) {
    if ($_GET['topic'] == 1) {
        $class1 = 'active';
    } else {
        $class2 = 'active';
    }
} else {
    $class1 = 'active';
}
?>

<div class="slide_menu">
    <ul class="deep">
        <li class="<?php echo $class1; ?>">
            <?php
            echo CHtml::link('Кафедральные<div class="k_post"></div>', Yii::app()->urlManager->createUrl('post/index', array(
                        'group' => '1')), array('async' => 'async'));
            ?>
        </li>
        <li class="<?php echo $class2; ?>">
            <?php
            echo CHtml::link('Мировые<div class="w_post"></div>', Yii::app()->urlManager->createUrl('post/index', array(
                        'topic' => '2')), array('async' => 'async'));
            ?>
        </li>
    </ul>
</div>
<div class="content-gallery">

    <?php

    $this->widget('application.components.PostGrid', array(
        'id' => 'video-grid',
        'template' => '{summary} {items} {pager}',
        'pager' => array(
            'maxButtonCount' => 5,
            'firstPageLabel' => '',
            'prevPageLabel' => '<',
            'nextPageLabel' => '>',
            'lastPageLabel' => '',
            'header' => '',
        ),
        'itemsCssClass'=>'grid_table',
        'dataProvider' => $model->search_my(),

        'columns' => array(
            'id',
            array(
                'name' => 'title',
                'type' => 'raw',
                'value' => 'CHtml::link(CHtml::encode($data->title), $data->url)'
            ),
            array(
                'name' => 'status',
                'value' => 'Lookup::item("PostStatus",$data->status)',
                'filter' => Lookup::items('PostStatus'),
            ),
            array(
                'name' => 'create_time',
                'type' => 'datetime',
                'filter' => false,
            ),
            array(
                'class' => 'CButtonColumn',
            ),
        ),
    ));
    ?>


</div>
