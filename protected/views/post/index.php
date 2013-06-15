<h1 class="pontel">Новости</h1>
<div id="breadcrambs">
    <?php
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links' => array(
            'Статьи'
        ),
        'separator' => '<span> / <span>'
    ));
    ?>
</div>
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
            <?php echo CHtml::link('Кафедральные<div class="k_post"></div>', Yii::app()->urlManager->createUrl('post/index', array('group' => '1'))); ?>
        </li>
        <li class="<?php echo $class2; ?>">
            <?php echo CHtml::link('Мировые<div class="w_post"></div>', Yii::app()->urlManager->createUrl('post/index', array('topic' => '2'))); ?>
        </li>
    </ul>
</div>
<div class="content-gallery">

    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'viewData' => array(
            'type_1' => $type_1,
            'plus_1' => $plus_1,
            'minus_1' => $minus_1,
            'gost_or_user' => $gost_or_user,
        ),
        'itemView' => '_view2',
        'template' => "{items}\n{pager}",
        'pager' => array(
            'class' => 'ext.yiinfinite-scroll.YiinfiniteScroller',
            'contentSelector' => 'div.items',
            'itemSelector' => 'div.list-view',
        )
    ));
    ?>


</div>
