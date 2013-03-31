<div id="breadcrambs">
    <?php
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links' => array(
            'Форум'
        ),
        'separator' => '<span> / <span>'
    ));
    ?>
</div>
<?php if (!Yii::app()->user->isGuest): ?>
    <div class="write_small_post">
        <div class="table_t ">
            <div class="tr_t">
                <div class="td_t wsp">
                    <div class="my_p ">
                        <?php
                        $my_picter = Yii::app()->createAbsoluteUrl('i/mini_avatar.png');
                        if (!is_null($athor->file_id)) {
                            $file_name = $athor->uploadedfiles->name;
                            $my_picter = Yii::app()->createAbsoluteUrl('uploads/avatar/mini_' . $file_name);
                        }
                        ?>
                        <?php echo CHtml::link("<img  src='$my_picter' />", Yii::app()->urlManager->createUrl('/user/ViewProfile', array('id' => $profile->id)), array('class' => 'classic')); ?>
                    </div>
                </div>
                <div class="td_t">
                    <div class="my_t">
                        <div name="dolghnost"  id='disifen' class="div_textare"  contentEditable="true" ></div>
                        <div class="inp_sub" id="new_obs" onclick="NewSmallPost(<?php echo $type; ?>,<?php echo $profile->id; ?>)">Отправить</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>

<?php endif; ?>
<div class="anchor"></div>
<div class="small_posts_view">
    <?php
    if (!empty($discussions)) {
        foreach ($discussions as $discussion) {
            if ($discussion->parent_id == NULL)
                $this->renderPartial('application.views.user._small_post', array(
                    'discussion' => $discussion,
                    'type' => $type,
                    'plus' => $plus,
                    'minus' => $minus,
                    'profile' => $athor,
                    'hozyin' => $profile
                        )
                );
        }
    }
    ?>
</div>