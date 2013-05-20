<?php
if (isset($_GET['sect'])) {
    $sect = $_GET['sect'];
} else {
    $sect = 'student';
}
?>
<script type="text/javascript" src="../../js/jq-scrool_old.js"></script>
<script>
    $(function(){
        var open_tab = "<?php echo $sect; ?>";
        $("select.select_week").change(function () {
            alert($(this).attr('value'));
        })
        $('.slide_menu ul li[tab="'+open_tab+'"]').addClass('active');
        openTab(open_tab);
        
        url = '/user/ManageGroup/'
        
        if("addEventListener" in window) { 
        
            window.addEventListener('popstate', function(e){
                if(e.state != undefined)
                    openTab(e.state);
            }, false);

        } else if ("attachEvent" in window) { 
            // выполнится для IE8 и ниже 
            window.attachEvent('popstate', function(e){
                if(e.state != undefined)
                    openTab(e.state);
            }, false); 
        } 
  
        function strpos (haystack, needle, offset) {
            var i = (haystack + '').indexOf(needle, (offset || 0));
            return i === -1 ? false : i;
        }
        $('.slide_menu ul li').click(function(){
            var tab = $(this).attr('tab');
            openTab(tab);
            history.pushState(tab, '', url+'?sect='+tab );            
        });
        
        
        $('.slide_menu ul li').live('click', function (){
            
            $('.slide_menu ul li').removeClass('active'); 
            $(this).addClass('active');
        });
    });
</script>

<div class="slide_menu">
    <ul class="">
        <li tab="student">
            Студенты
            <div></div>
        </li>
        <li tab="predmets">
            Предметы
            <div></div>
        </li>
        <li tab="info">
            Инфа группы
            <div></div>
        </li>
    </ul>
</div>



<div id="razdel" class="ent-razdel" tab="student" style="display: none;">
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
            <div class="td_t">
                <span>
                    <label >Удалить из группы</label>
                </span>
                <div></div>
            </div>
            <div class="td_t">
                <span>
                    <label >Забанить</label>
                </span>
                <div></div>
            </div>
            <div class="td_t">
                <span>
                    <label >Подтвежденный</label>
                </span>
                <div></div>
            </div>

        </div>
        <?php $index = 1; ?>
        <?php foreach ($students as $student): ?>
            <div class="tr_t">
                <div class="td_t">
                    <label ><?php echo $index; ?></label>
                </div>
                <div class="td_t">
                    <?php
                    $picter = Yii::app()->createAbsoluteUrl('i/mini_avatar.png');
                    if (!is_null($student->file_id)) {
                        $file_name = $student->uploadedfiles->name;
                        $picter = Yii::app()->createAbsoluteUrl('uploads/avatar/mini_' . $file_name);
                    }
                    ?>
                    <?php echo CHtml::link("<img  src='$picter' />", Yii::app()->urlManager->createUrl('user/ViewProfile/', array('id' => $student->id)), array('class' => 'classic')); ?>
                </div>
                <div class="td_t">
                    <?php
                    if (isset($student->patronymic)) {
                        $name = $student->surname . ' ' . $name = $student->name . ' ' . $student->patronymic;
                    } else {
                        $name = $student->surname . ' ' . $name = $student->name;
                    }
                    ?>

                    <?php echo CHtml::link($name, Yii::app()->urlManager->createUrl('user/ViewProfile/', array('id' => $student->id)), array('class' => 'classic')); ?>
                </div>
                <div class="td_t">
                    <?php echo CHtml::link($student->team->name . ' 1-' . $student->team->inseption->prefix_year, Yii::app()->urlManager->createUrl('/reestr/group/' . $student->team->id), array('class' => 'classic')); ?>
                </div>
                <div class="td_t">
                    <?php echo $student->mean ?>
                </div>
                <div class="td_t">
                    удалить
                </div>
                <div class="td_t">
                    забанить
                </div>
                <div class="td_t">

                </div>
            </div>
            <?php $index++; ?>
        <?php endforeach; ?>

    </div>
</div>

<div id="razdel" class="ent-razdel" tab="predmets" style="display: none;">
    <div class="podobiu classic" onclick="podobiu(<?php echo $group->id; ?>)">
        Заполнить по подобию
    </div>

    <h1 class="maine_group" group_id='<?php echo $group->id; ?>'>
        Группа: <?php echo $group->name . " 1-" . $group->inseption->prefix_year; ?>

    </h1>
    <ul>
        <div class='group_user_redact' onclick="groupList(<?php echo $group->id; ?>)">Редактировать список группы</div>

    </ul>
    <div class="form-box">
        <div class="resume__hint__block g-round m-round_5">Тщательно и внимательно заполняйте эту форму, список этих предметов будет виден Всем.<br/>
            Далее из него можно будет составить расспиание            
        </div>
        <div class="resume__hint__block__tail g-shy"> </div>
    </div>
    <?php
    $semestr = 1;

    $kurs = '1'; //
    $odd = "1";
    $even = "2";
    for ($i = 0; $i <= 9; $i++) {
        echo "<div class='block_kurs'>";
        echo "<div class='resume__experiences__total'></div>";
        echo "<h4 class='lokol'>$kurs курс</h4>";
        echo "<div class='block_semestr'>";
        echo "<h4>$odd семестр</h4>";
        echo "<ul class='predmets_for_groups'>";
        $do_increment = $semestr + $i;
        $mk = '1';

        foreach ($psg_model as $prdemt_semestr) {
            if ($prdemt_semestr->semestr_id == $do_increment) {
                if (isset($prdemt_semestr->predmet)) {
                    echo "<li>";
                    echo CHtml::link($prdemt_semestr->predmet->name, Yii::app()->urlManager->createUrl('/library/predmet/' . $prdemt_semestr->predmet_id), array('class' => 'classic'));
                    echo "</li>";
                }
                $mk++;
            }
        }
        echo "</ul>";
        if ($mk != '1') {
            echo "<div class='semestr_create redact-s' onclick='EditList($group->id, $do_increment)' >Редактировать семестр</div><div class='anchor'></div>";
        } else {
            echo "<div class='semestr_create add-s' semestr_id='$do_increment' onclick='EditList($group->id, $do_increment)'>Создать семестр</div><div class='anchor'></div>";
        }

        echo "</div>";

        echo "<div class='peregordka'></div>";

        echo '<div class="block_semestr">';
        echo "<h4>$even семестр</h4>";
        echo "<ul class='predmets_for_groups'>";
        $posle_increment = $semestr + (++$i);
        $lk = '1';
        foreach ($psg_model as $prdemt_semestr) {
            if ($prdemt_semestr->semestr_id == $posle_increment) {
                echo "<li>";
                echo CHtml::link($prdemt_semestr->predmet->name, Yii::app()->urlManager->createUrl('/library/predmet/' . $prdemt_semestr->predmet_id), array('class' => 'classic'));
                echo "</li>";
                $lk++;
            }
        }
        echo "</ul>";
        if ($lk != '1') {
            echo "<div class='semestr_create redact-s'  onclick='EditList($group->id, $posle_increment)'>Редактировать семестр</div><div class='anchor'></div>";
        } else {
            echo "<div class='semestr_create add-s' semestr_id='$posle_increment' onclick='EditList($group->id, $posle_increment)' >Создать семестр</div><div class='anchor'></div>";
        }
        echo "</div>";
        echo "</div>";
        $kurs++;
    }
    ?>

</div>

<div id="razdel" class="ent-razdel" tab="info" style="display: none;">
    <div class="">
        <h1>Инфа группы</h1>
        <ul>
            <li>
                <label>
                    Количество судентов в группе
                    <select>
                        <option value="0"> &mdash; </option>
                        <?php for ($i = 1; $i <= 50; $i++): ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </label>
            </li>
            <li>
                <label>
                    Куратор группы
                    <select>
                        <option value="0"> &mdash; </option>
                        <?php foreach ($prepods as $prepod): ?>
                            <option value="<?php echo $prepod->id; ?>"><?php echo $prepod->name . ' ' . $prepod->surname; ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <div class="">
                    Если куратор не зарегистрирован введите его имя
                </div>
            </li>
            <li>
                <label>
                    email группы
                    <input type="text">
                </label>
                <label>
                    пароль от почты 
                    <div class="">пароль виден только студентам в группе</div>
                    <input type="text">
                </label>
            </li>
            <li>
                <label>
                    Староста группы
                    <input type="text">
                </label>
            </li>
        </ul>
        <input type="submit" value="Сохранить" />
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.save_but_predmet_curs').click(function(){
            var predmets_id = new Object;
            var otm_predmets_id = new Object;
            var otm_predmets_text = new Object;
            var bhk = '';
            
            $(".predmet_goupview li[check='check']:not(.predmet_goupview li.acupent)").each(function(index) { //
                otm_predmets_id[index] = $(this).attr('id');
                otm_predmets_text[index] = $(this).text();
            });
            
            for(var key in otm_predmets_text){
                var bhk = bhk + otm_predmets_text[key];
            }
            if(bhk==''){
                selectPredmet();
            }else{
                var r=confirm("Вы уверенны что хотите удалить предметы:''"+bhk+"''? Все оценки, заполненные студентами этой группы по этому(этим) предметам(у) будут удалены без возможности востановления")
                if (r==true)
                {
                    selectPredmet();
                }
                
            }
            function selectPredmet(){
                loader.show();
                semestr_id = '1';
                group = <?php echo $group->id; ?>;
            
            
                $('.predmet_goupview li.acupent').each(function(index) { 
                    predmets_id[index] = $(this).attr('id');
                });
            
                $.ajax({
                    url: '<?php echo $this->CreateUrl('admin/SelectPredmets'); ?>',
                    type: 'POST',
                    data: {
                        "semestr_id":semestr_id,
                        "otm_predmets_id":otm_predmets_id,
                        "predmets_id":predmets_id,
                        "group":group
                    },
                    dataType: 'json',
                    success: function(result)
                    {
                        location.reload();
                    }
                }); 
            }
            
        });
       
        $('.acupent').attr('check','check');
    });
</script>