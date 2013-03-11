<div id="breadcrambs">
    <?php
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links' => array(
            'Библиотека'
        ),
        'separator' => '<span> / <span>'
    ));
    ?>
</div>
<ul class="predmets">
    <?php foreach ($predmets as $predmet): ?>
        <li>
            <?php echo CHtml::link($predmet->name, Yii::app()->urlManager->createUrl('/library/predmet', array('id' => $predmet->id)), array('class' => 'classic')); ?>
        </li>
    <?php endforeach; ?>
</ul>