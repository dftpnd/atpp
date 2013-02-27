<?php $picter = Yii::app()->createAbsoluteUrl('i/mini_avatar.png'); ?>
<?php if (!empty($models)): ?>
  <?php foreach ($models as $model): ?>
    <?php
    if (isset($model->patronymic)) {
      $name = $model->name . ' ' . $model->patronymic;
    } else {
      $name = $model->name . ' ' . $model->surname;
    }



    $picter = Yii::app()->createAbsoluteUrl('i/mini_avatar.png');
    if (!is_null($model->file_id)) {
      $file_name = $model->uploadedfiles->name;
      $picter = Yii::app()->createAbsoluteUrl('uploads/avatar/mini_' . $file_name);
    }
    ?>

    <div class="student_vew">
      <?php echo CHtml::link("<img  src='$picter' />", Yii::app()->urlManager->createUrl('user/ViewProfile/', array('id' => $model->id)), array('class' => 'classic userabyl')); ?>
      <?php echo CHtml::link($name, Yii::app()->urlManager->createUrl('user/ViewProfile/', array('id' => $model->id)), array('class' => 'classic usename_st')); ?>
    </div>
    <div class="anchor"></div>

  <?php endforeach; ?>
<?php else: ?>
  <p>Пока тут никого нет..</p>
<?php endif; ?>
