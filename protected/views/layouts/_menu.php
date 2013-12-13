<div class="menu">
  <?php
  $this->widget('zii.widgets.CMenu', array(
      'items' => array(
          array(
              'label' => 'Главная',
              'url' => Yii::app()->urlManager->createUrl('site/index'),
              'linkOptions' => array(
                  'async' => 'async',
              ),
             ),
          array(
              'label' => 'Статьи',
              'linkOptions' => array(
                  'async' => 'async',
              ),
              'url' => Yii::app()->urlManager->createUrl('post/index'),
              ),
          array(
              'label' => 'Реестр',
              'url' => Yii::app()->urlManager->createUrl('reestr/index'),
              'linkOptions' => array(
                  'async' => 'async',
              ),
          ),
          array(
              'label' => 'Форум',
              'url' => Yii::app()->urlManager->createUrl('forum/index'),
              'linkOptions' => array(
                  'async' => 'async',
              ),
              ),
          array(
              'label' => 'Вход',
              'url' => ('#'),
              'linkOptions' => array('onclick' => 'EnterSite()'),
              'visible' => Yii::app()->user->isGuest,
          ),
          array(
              'label' => 'Выход',
              'url' => Yii::app()->urlManager->createUrl('site/logout'),
              'visible' => !Yii::app()->user->isGuest)
      ),));
  ?>
</div>
