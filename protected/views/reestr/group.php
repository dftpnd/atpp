<?php
if (isset($_GET['sect'])) {
    $se = $_GET['sect'];
} else {
    $se = 'staff_group';
}
?>

<script type="text/javascript">
    $(document).ready(function() {
        
        $('.slide_menu ul li[tab="<?php echo $se ?>"]').addClass('active');
        openTab('<?php echo $se ?>');
        
        var url = '/reestr/group/<?php echo $group->id ?>';
        
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
            alert('asd');
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
<div id="breadcrambs">
    <?php
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links' => array(
            'Реестр групп' => '/reestr/index',
            'Просмотр группы ' . $group->name . ' 1-' . $group->inseption->prefix_year
        ),
        'separator' => '<span> / <span>'
    ));
    ?>
</div>
<div class="slide_menu">
    <ul>
        <li class='' id="card_menu_2" razdel="1" tab="staff_group" >
            Состав группы
            <div></div>
        </li>
        <li class='' id="card_menu_3" razdel="2" tab="items_group" >
            Предметы группы
            <div></div>
        </li>
        <li class='' id="card_menu_3" razdel="2" tab="schedule_group" >
            Расписание группы
            <div></div>
        </li>
    </ul>
</div>
<div class="anchor"></div>

<div id="razdel1" class="ent-razdel" tab="staff_group" style="display: none;">
    <form id="student_compare" >
        <input type="hidden" name="group_id" value='<?php echo $group->id ?>' />
        <?php
        if (isset($profiles)) {
            echo "<div class='table_t'>";
            echo "<div class='tr_t reestr'>
                <div class='td_t'><span class='compare_values' title='Сравнить' onclick='prepearStudent()'></span></div>
                <div class='td_t'>&nbsp;</div>
                <div class='td_t'>Фамилия Имя</div>
                <div class='td_t'>Средний бал</div>
              </div>";


            $sep = 'rator';
            foreach ($profiles as $profile) {
                $picter = Yii::app()->createAbsoluteUrl('i/mini_avatar.png');
                if (!is_null($profile->file_id)) {
                    $file_name = $profile->uploadedfiles->name;
                    $picter = Yii::app()->createAbsoluteUrl('uploads/avatar/mini_' . $file_name);
                }

                if ($sep == 'rator') {
                    $sep = 'factor';
                } else {
                    $sep = 'rator';
                }
                echo "<div class='tr_t $sep studentd_reestr' profile_id='$profile->id' >";

                echo "<div class='td_t'><input type='checkbox'  name='students[]' value='$profile->id' /></div>";
                echo "<div class='td_t'><div class='face'><img onclick='getProfile($profile->id,$group->id)' src='$picter' /></div></div>";
                if ($profile->name == '') {
                    echo "<div class='td_t'><span class='st_login' >" . $profile->user->username . "</span></div>";
                } else {
                    echo "<div class='td_t'>";
                    echo CHtml::link(
                            $profile->surname
                            . '&nbsp;' .
                            $profile->name, Yii::app()->urlManager->createUrl('/user/ViewProfile', array('id' => $profile->id)), array('class' => 'classic')
                    );
                    echo "</div>";
                }
                $sr_user_class = '';
                if (isset($profile->mean)) {
                    $mean = $profile->mean;
                    $sr_user_class = 'hor';
                    if (4.5 < $mean) {
                        $sr_user_class = 'otl';
                    }
                    if (3.5 > $mean) {
                        $sr_user_class = 'udov';
                    }
                } else {
                    $mean = '&mdash;';
                }
                echo "<div class='td_t'><span class='sr_user $sr_user_class'>$mean</span></div>";
                echo '</div>';
            }
            echo "</div>";
        }
        ?>
    </form>
</div>
<div id="razdel2" class="ent-razdel" tab="items_group" style="display: none;">
    <div class="stats_box"></div>
</div>
<div id="razdel3" class="ent-razdel"  tab="schedule_group" style="display: none;">
    <?php
    $this->renderPartial('application.views.user.new_schedule', array(
        'wekdays' => $wekdays,
        'data' => $data,
        'data2' => $data2,
        'data3' => $data3,
        'type_pair' => $type_pair,
        'time_pair' => $time_pair,
        'semestr' => $semestr,
        'we' => $we
            )
    )
    ?>
    <div class="stats_box_2"></div>
</div>
<script>
    $(function(){
        uploadPredmetGroup(<?php echo $group->id ?>);
    });
</script>