<script type="text/javascript" src="../../js/jq-scrool_old.js"></script>
<h1 class="pontel">Студенты</h1>
<?php
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links' => array(
        'Реестр' => '/reestr/index',
        'Студенты'
    ),
    'separator' => '<span> / <span>'
));
?>

<div class="anchor"></div>
<div class="table_t reestr">
    <div class="tr_t">
        <div class="td_t">
            <span>
                <label >№</label>
            </span>
            <div></div>
        </div>
        <div class="td_t">
            <span>
                <label >Фото</label>
            </span>
            <div></div>
        </div>
        <div class="td_t">
            <span>
                <label >ФИО:</label>
            </span>
            <div></div>
        </div>
        <div class="td_t">
            <span>
                <label >Группа</label>
            </span>
            <div></div>
        </div>
        <div class="td_t">
            <span>
                <label >Средний бал</label>
            </span>
            <div></div>
        </div>

    </div>
    <?php $index = 1; ?>
    <?php foreach ($models as $model): ?>
        <div class="tr_t">
            <div class="td_t">
                <label ><?php echo $index; ?></label>
            </div>
            <div class="td_t">
                <?php
                $picter = Yii::app()->createAbsoluteUrl('i/mini_avatar.png');
                if (!is_null($model->file_id)) {
                    $file_name = $model->uploadedfiles->name;
                    $picter = Yii::app()->createAbsoluteUrl('uploads/avatar/mini_' . $file_name);
                }
                ?>
                <?php echo CHtml::link("<img  src='$picter' />", Yii::app()->urlManager->createUrl('user/ViewProfile/', array('id' => $model->id)), array('class' => 'classic')); ?>
            </div>
            <div class="td_t">
                <?php
                if (isset($model->patronymic)) {
                    $name = $model->surname . ' ' . $name = $model->name . ' ' . $model->patronymic;
                } else {
                    $name = $model->surname . ' ' . $name = $model->name;
                }
                ?>

                <?php echo CHtml::link($name, Yii::app()->urlManager->createUrl('user/ViewProfile/', array('id' => $model->id)), array('class' => 'classic')); ?>
            </div>
            <div class="td_t">
                <?php echo CHtml::link($model->team->name . ' 1-' . $model->team->inseption->prefix_year, Yii::app()->urlManager->createUrl('/reestr/group/' . $model->team->id), array('class' => 'classic')); ?>
            </div>
            <div class="td_t">
                <?php echo $model->mean?>
            </div>
        </div>
        <?php $index++; ?>
    <?php endforeach; ?>

</div>
<script>
    $(document).ready(function(){
        $('.reestr').fixedtableheader(); 
    });
</script>