<h1>Реестры</h1>
<?php
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links' => array(
        'Реестры'
    ),
    'separator' => '<span> / <span>'
));
?>
<ul>
    <li>
        <a href="/user/students">
            Студенты
        </a>
    </li>
    <li>
        <a href="/user/prepods">
            Преподаватели
        </a>
    </li>
    <li>
        <a href="/reestr/GroupReestr">
            Групы
        </a>
    </li>
    <li>
        <a href="/library/index">
            Библиотека
        </a>
    </li>
</ul>