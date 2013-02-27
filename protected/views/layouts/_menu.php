<div class="menu">
    <?php
    $this->widget('zii.widgets.CMenu', array(
        'items' => array(
            array(
                'label' => 'Главная',
                'url' => Yii::app()->urlManager->createUrl('site/index'),
                'active' => (Yii::app()->controller->getId() == 'site' &&
                Yii::app()->controller->getAction()->getId() == 'index')),
            array(
                'label' => 'Статьи',
                'url' => Yii::app()->urlManager->createUrl('post/index'), 'active' => (Yii::app()->controller->getId() == 'post' && Yii::app()->controller->getAction()->getId() == 'index') | (Yii::app()->controller->getId() == 'post' && Yii::app()->controller->getAction()->getId() == 'view')),
            array(
                'label' => 'Реестр',
                'url' => Yii::app()->urlManager->createUrl('reestr/index'),
                'active' => (Yii::app()->controller->getId() == 'reestr' &&
                Yii::app()->controller->getAction()->getId() == 'index') |
                (Yii::app()->controller->getId() == 'reestr' &&
                Yii::app()->controller->getAction()->getId() == 'group')),
            array(
                'label' => 'Фотогалерея',
                'url' => Yii::app()->urlManager->createUrl('site/photos'),
                'active' => (Yii::app()->controller->getAction()->getId() == 'photos') |
                (Yii::app()->controller->getId() == 'post' &&
                Yii::app()->controller->getAction()->getId() == 'scrapbook') |
                (Yii::app()->controller->getAction()->getId() == 'phototools')),
            array(
                'label' => 'Контакты',
                'url' => Yii::app()->urlManager->createUrl('site/contact'),
                'active' => (Yii::app()->controller->getId() == 'site' &&
                Yii::app()->controller->getAction()->getId() == 'contact')),
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
