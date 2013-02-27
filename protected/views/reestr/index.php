<div id="breadcrambs">
    <?php
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links' => array(
            'Реестр групп'
        ),
        'separator' => '<span> / <span>'
    ));
    ?>
</div>
<form id="student_group">
    <div class="table_t ">
        <div class="tr_t reestr">
            <div class="td_t">
                <span class="compare_values" title="Сравнить" onclick="prepearGroup()"></span>
            </div>
            <div class="td_t">
                <label for="name">Имя:</label>
                <select>
                    <option>все</option>
                    <?php foreach ($name_group as $key => $value): ?>
                        <option value="<?php echo $value; ?>"><?php echo $key; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="td_t">
                <label for="year">Год:</label>
                <select>
                    <option>все</option>
                    <?php foreach ($year as $key => $value): ?>
                        <option value="<?php echo $value; ?>"><?php echo $key; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="td_t">
                Средний балл
            </div>
            <div class="td_t">
                Процент зарегистрировавшихся
            </div>
            <div class="td_t">
                Куратор группы
            </div>


        </div>


        <?php
        $sep = 'rator';
        foreach ($groups as $group) {
            if (!is_null($group->students) && !is_null($group->all_man)) {
                $percent = round(($group->students * 100) / $group->all_man);
            } else {
                $percent = 1;
            }
            if ($sep == 'rator') {
                $sep = 'factor';
            } else {
                $sep = 'rator';
            }
            echo "<div class='tr_t $sep' id='$group->id'>";
            echo "<div class='td_t'><input type='checkbox' name='groups[]' value='$group->id' /></div>";
            echo "<div class='td_t'>";
            echo CHtml::link($group->name . ' 1-' . $group->inseption->prefix_year, Yii::app()->urlManager->createUrl('/reestr/group', array('id' => $group->id)), array('class' => 'group classic'));
            echo "</div>";
            echo "<div class='td_t'>" . $group->inseption->start_year . "</div>";
            echo "<div class='td_t'>$group->mean</div>";
            echo "<div class='td_t'><div class='maine_bar'  title='" . $percent . "%' ><div class='' style='width:" . $percent . "%'  title='" . $percent . "%' ></div></div></div>";
            echo "<div class='td_t'> $group->curator </div>";


            echo "</div>";
        }
        ?>
    </div>
</form>