<div id="breadcrambs">
    <?php
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links' => array(
            'Предметы' => '/userAdmin/admin/predmet',
            'Редактировать предмет'
        ),
        'separator' => '<span> / <span>'
    ));
    ?>
</div>
<?php
var_dump($model);
?>