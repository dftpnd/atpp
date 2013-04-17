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
                'label' => 'Преподаватели',
                'url' => Yii::app()->urlManager->createUrl('user/prepods'),
                'visible' => !Yii::app()->user->isGuest,
                'active' => (
                Yii::app()->controller->getId() == 'user' && Yii::app()->controller->getAction()->getId() == 'prepods'),
                'itemOptions' => array('class' => 'menu_prepods')
            ),
            array(
                'label' => 'Студенты',
                'url' => Yii::app()->urlManager->createUrl('user/students'),
                'visible' => !Yii::app()->user->isGuest,
                'active' => (
                Yii::app()->controller->getId() == 'user' && Yii::app()->controller->getAction()->getId() == 'students'),
                'itemOptions' => array('class' => 'menu_students')
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
                'label' => 'Группа',
                'url' => Yii::app()->urlManager->createUrl('user/mygroup'),
                'visible' => !Yii::app()->user->isGuest, 'active' => (Yii::app()->controller->getId() == 'user' && Yii::app()->controller->getAction()->getId() == 'mygroup'),
                'itemOptions' => array('class' => 'menu_group')
            ),
            array(
                'label' => 'Расписание',
                'url' => Yii::app()->urlManager->createUrl('user/schedule'),
                'visible' => !Yii::app()->user->isGuest, 'active' => (Yii::app()->controller->getId() == 'user' && Yii::app()->controller->getAction()->getId() == 'schedule'),
                'itemOptions' => array('class' => 'menu_schedule')
            ),
            array(
                'label' => 'Преподаватели',
                'url' => Yii::app()->urlManager->createUrl('user/prepods'),
                'visible' => !Yii::app()->user->isGuest,
                'active' => (
                Yii::app()->controller->getId() == 'user' && Yii::app()->controller->getAction()->getId() == 'prepods'),
                'itemOptions' => array('class' => 'menu_prepods')
            ),
//            array(
//                'label' => 'Файлы',
//                'url' => Yii::app()->urlManager->createUrl('user/groupfile'),
//                'visible' => !Yii::app()->user->isGuest, 'active' => (Yii::app()->controller->getId() == 'user' && Yii::app()->controller->getAction()->getId() == 'groupfile'),
//                'itemOptions' => array('class' => 'groupfile')
//            ),
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
                Yii::app()->user->getRole() == 'administrator' ||
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
                'visible' => (
                Yii::app()->user->getRole() == 'administrator' ||
                Yii::app()->user->getRole() == 'authority'),
                'itemOptions' => array('class' => 'menu_admin')
            ),
        ),));
    ?>
  </div>
<?php endif; ?>
