<?php if (Yii::app()->user->isPrepod()): ?>
  <div class="menu_work">
    <?php
    $this->widget('zii.widgets.CMenu', array(
        'items' => array(
            array(
                'label' => 'Моя страница',
                'url' => Yii::app()->urlManager->createUrl('user/ViewProfile/'),
                'visible' => !Yii::app()->user->isGuest,
                'active' => (Yii::app()->controller->getId() == 'user' && Yii::app()->controller->getAction()->getId() == 'ViewProfile'),
                'itemOptions' => array('class' => 'menu_profile'),
                'items' => array(
                    array(
                        'label' => 'ред.',
                        'url' => Yii::app()->urlManager->createUrl('user/editprofile/' . Yii::app()->user->id),
                        'visible' => !Yii::app()->user->isGuest,
                        'active' => (Yii::app()->controller->getId() == 'user' && Yii::app()->controller->getAction()->getId() == 'editprofile'),
                        'itemOptions' => array('class' => 'menu_editprofile'),
                    ),
                ),
            ),
            array(
                'label' => 'Написать статью',
                'url' => Yii::app()->urlManager->createUrl('post/create'),
                'visible' => !Yii::app()->user->isGuest,
                'active' => (
                Yii::app()->controller->getId() == 'post' && Yii::app()->controller->getAction()->getId() == 'create'),
                'itemOptions' => array('class' => 'menu_review')
            ),
        ),));
    ?>
  </div>
<?php else: ?>
  <div class="menu_work">
    <?php
    $this->widget('zii.widgets.CMenu', array(
        'items' => array(
            array(
                'label' => 'Моя страница',
                'url' => Yii::app()->urlManager->createUrl('user/ViewProfile/'),
                'visible' => !Yii::app()->user->isGuest,
                'active' => (Yii::app()->controller->getId() == 'user' && Yii::app()->controller->getAction()->getId() == 'ViewProfile'),
                'itemOptions' => array('class' => 'menu_profile'),
                'items' => array(
                    array(
                        'label' => 'ред.',
                        'url' => Yii::app()->urlManager->createUrl('user/editprofile/' . Yii::app()->user->id),
                        'visible' => !Yii::app()->user->isGuest,
                        'active' => (Yii::app()->controller->getId() == 'user' && Yii::app()->controller->getAction()->getId() == 'editprofile'),
                        'itemOptions' => array('class' => 'menu_editprofile'),
                    ),
                ),
            ),
            array(
                'label' => 'Расписание',
                'url' => Yii::app()->urlManager->createUrl('user/schedule'),
                'visible' => !Yii::app()->user->isGuest, 'active' => (Yii::app()->controller->getId() == 'user' && Yii::app()->controller->getAction()->getId() == 'schedule'),
                'itemOptions' => array('class' => 'menu_schedule')
            ),
            array(
                'label' => 'Управление группой',
                'url' => Yii::app()->urlManager->createUrl('user/ManageGroup'),
                'visible' => (Yii::app()->user->getRole() == 'manegergroup') || (Yii::app()->user->getRole() == 'authority'),
                'itemOptions' => array('class' => 'manage_group')
            ),
            array(
                'label' => 'Написать статью',
                'url' => Yii::app()->urlManager->createUrl('post/create'),
                'visible' => !Yii::app()->user->isGuest,
                'active' => (
                Yii::app()->controller->getId() == 'post' && Yii::app()->controller->getAction()->getId() == 'create'),
                'itemOptions' => array('class' => 'menu_review')
            ),
            array(
                'label' => 'Упр. статьями',
                'url' => Yii::app()->urlManager->createUrl('post/admin'),
                'active' => Yii::app()->controller->getAction()->getId() == 'admin',
                'visible' => (
                (
                Yii::app()->user->getRole() == 'authority')
                ),
                'itemOptions' => array('class' => 'menu_management')
            ),
            array(
                'label' => 'Cобытие',
                'url' => Yii::app()->urlManager->createUrl('site/activity'),
                'active' => (Yii::app()->controller->getId() == 'site' && Yii::app()->controller->getAction()->getId() == 'activity'),
                'visible' => (
                Yii::app()->user->getRole() == 'administrator' ||
                Yii::app()->user->getRole() == 'authority'),
                'itemOptions' => array('class' => 'activity')
            ),
            array(
                'label' => 'Слайды',
                'url' => Yii::app()->urlManager->createUrl('slide/admin'),
                'active' => (Yii::app()->controller->getId() == 'slide' && Yii::app()->controller->getAction()->getId() == 'admin'),
                'visible' => (
                Yii::app()->user->getRole() == 'administrator' ||
                Yii::app()->user->getRole() == 'authority'),
                'itemOptions' => array('class' => 'slide')
            ),
            array(
                'label' => 'Админка',
                'url' => Yii::app()->urlManager->createUrl('userAdmin/admin/users'),
                'active' => (
                Yii::app()->controller->getAction()->getId() == 'aprovemoder' ||
                Yii::app()->controller->getAction()->getId() == 'mail' ||
                Yii::app()->controller->getId() == 'authitem'
                ),
                'visible' => (Yii::app()->user->getRole() == 'authority'),
                'itemOptions' => array('class' => 'menu_admin')
            ),
        ),));
    ?>
  </div>
<?php endif; ?>
