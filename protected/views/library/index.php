<h1 class="pontel">Библиотека</h1>
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


<div class="anchor"></div>
<div class="table_t table_library">
    <div class="tr_t reestr">
        <div class="td_t">
            №
        </div>
        <div class="td_t">
            <label >Наименование:</label>
        </div>
        <div class="td_t">
            <label >Кол. загруженых файлов:</label>
        </div>
        <div class="td_t">
            <label >Кол. преподавателей</label>
        </div>
        <div class="td_t">
            <label >Институт</label>
        </div>
        <div class="td_t">
            <label >Кафедра</label>
        </div>
    </div>
    <?php $index = 1; ?>
    <?php foreach ($predmets as $predmet): ?>
        <div class="tr_t">
            <div class="td_t">
                <label ><?php echo $index; ?></label>
            </div>
            <div class="td_t">
                <?php echo CHtml::link($predmet->name, Yii::app()->urlManager->createUrl('/library/predmet', array('id' => $predmet->id)), array('class' => 'classic')); ?>
            </div>
            <div class="td_t">
                <label class="fosee" >   
                    <?php echo count($predmet->predmetfile); ?>
                </label>
            </div>
            <div class="td_t">
                <label class="fosee" > <?php echo count($predmet->predmetprepod); ?></label>
            </div>
            <div class="td_t">
                <?php
                $ins_name = '';
                $caf_name = '';

                if (isset($predmet->cafedra->id)) {
                    $caf_name = $predmet->cafedra->name;
                    $ins_name = '';

                    if ($predmet->institutecafedra->institute_id == 2) {
                        $ins_name = "ИТЭ";
                    } elseif (($predmet->institutecafedra->institute_id == 3)) {
                        $ins_name = "ИЭИТ";
                    } elseif (($predmet->institutecafedra->institute_id == 4)) {
                        $ins_name = "ИЭЭ";
                    }
                }
                ?>
                <label >
                    <?php echo $ins_name; ?>
                </label>
            </div>
            <div class="td_t">
                <label >
                    <?php echo $caf_name; ?>
                </label>
            </div>
        </div>
        <?php $index++; ?>
    <?php endforeach; ?>

</div>
<script>
    $('.table_library .tr_t').click(function(){
        $('.table_library .tr_t').removeClass('active_tr');
        $(this).addClass('active_tr');
    });
</script>