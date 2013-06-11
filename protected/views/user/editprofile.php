<script>
    $(function(){
        function createUploader(){            
            var uploader = new qq.FileUploader({
                element: document.getElementById('file-uploader-demo1'),
                action: '/user/UploadAvatar',
                onComplete: function(id, fileName, responseText)
                {   
                    $('.avatar img').remove();
                    $('.avatar').append('<img src="'+responseText.file_url+'" />');
                }
            });           
        }
        window.onload = createUploader;  
           
        if($('#Profile_status option[selected = selected]').attr('value') == '2'){
                
            $('.id_year_create-mask').show();
                
            $('select#Group_id_year_create option[value=<?php echo $yc; ?>]').attr('selected','selected');
<?php if (!isset($model->group_id)): ?>
                buldGroup(<?php echo $yc; ?>);
<?php endif; ?>
            
        }
        
        $('#Profile_status').change(function() {
            goSpiner();
            m = $(this).attr('value');
            if( m == '1'){
                $('.id_year_create-mask').hide()
                $('.group-mask').hide()
            }
            else if( m == '2'){
                $('.id_year_create-mask').show();
                $('.group-mask').show();
                
            }
            else if( m == '3'){
                $('.id_year_create-mask').hide()
                $('.group-mask').hide() 
            }
            else{
                //хайд ол
            }
            hideSpiner();
        });  
        $('#Group_id_year_create').change(function(){
            goSpiner();
            year_create_id = $(this).attr('value');
            if(year_create_id != ''){
                buldGroup(year_create_id);
            }
            hideSpiner();
        });
        
        
        $('#save_predmets_user').click(function (){
            
        });
        
<?php if (!isset($model->group_id)): ?>
            function buldGroup(year_create_id){
                $.ajax({
                    url: '<?php echo $this->CreateUrl('user/FindGroup'); ?>',
                    type: 'POST',
                    data: {
                        "year_create_id":year_create_id
                    },
                    dataType: 'html',
                    success: function(data)
                    {
                        if (data != null)
                        {   
                            $('.group-mask').html(data)
                            $('.group-mask').show()
                            $('select#Profile_group_id option[value=<?php echo $gi; ?>]').attr('selected','selected');
                            $('#Profile_group_id').change(function(){
                                if($(this).val() != ''){
                                    //alert('asdads');
                                    $('#save_but input').removeAttr('disabled','disabled ');                     
                                }
                            });
                        }
                        else{
                            alert('Произошла ошибка :(');
                        }
                    }
                });
            }
                                                                                                                                                                                                                                                                            
<?php endif; ?>
        
        $('.thone_c input').mask('(999) 999-99-99');
    });
   
</script>
<div class="razdel " list='1'>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-lk',
        'method' => 'post',
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
    ?>
    <div class="table_t editprofile">
        <div class="tr_t">
            <div class="td_t">
                <div class="lft_b resume__emptyblock" >
                    <div class="avatar">
                        <?php
                        $picter = Yii::app()->createAbsoluteUrl('i/avatar.svg');
                        if (!empty($model->file_id)) {
                            $file_name = $model->uploadedfiles->name;
                            $picter = Yii::app()->createAbsoluteUrl('uploads/avatar/avatar_' . $file_name);
                        }
                        ?>
                        <img src="<?php echo $picter; ?>" />
                    </div>

                    <div class="avatar_wind">
                        <div id="file-uploader-demo1">		
                            <noscript>			
                            <p>Включите JavaScript чтобы испльзовать file uploader.</p>
                            <!-- or put a simple form for upload here -->
                            </noscript>         
                        </div>
                        <ul class="uload_list">
                        </ul>
                    </div>
                </div>
                <div class="anchor"></div>
                <?php if ($model->status == 2): ?>
                    <div class="medal">
                        <span title="Средний балл успеваемости">
                            <?php if (isset($model->mean)) echo $model->mean ?>
                        </span>
                    </div>
                <?php endif; ?>

                <div class="anchor"></div>


            </div>
            <div class="td_t">
                <div class="resume__emptyblock" id="">
                    <ul class="social_contact">
                        <li>
                            <label class="social_img thone_c"  title="Контактактный телефон">
                                <?php echo $form->textField($model, 'pthon'); ?>
                                <?php echo $form->error($model, 'pthon'); ?>
                            </label>
                        </li>
                        <li>
                            <label class="social_img email_c" title="Контактактный адрес эл. почты">
                                <?php echo $form->textField($model, 'kontakt_email'); ?>
                                <?php echo $form->error($model, 'kontakt_email'); ?>
                            </label>
                        </li>
                        <li>
                            <label class="social_img web_c" title="Веб сайт">
                                <?php echo $form->textField($model, 'website'); ?>
                                <?php echo $form->error($model, 'website'); ?>
                            </label>
                        </li>
                        <li>
                            <label class="social_img vk_c" title="Авторизоваться">
                                <?php echo $form->textField($model, 'kontact'); ?>
                                <?php echo $form->error($model, 'kontact'); ?>
                            </label>
                        </li>
                        <li>
                            <label class="social_img skype_c" title="Скайп">
                                <?php echo $form->textField($model, 'skype'); ?>
                                <?php echo $form->error($model, 'skype'); ?>
                            </label>
                        </li>
                    </ul>
                    <div class="anchor"></div>
                </div>

                <div class="right_b resume__emptyblock" id="idet_prof">
                    <div class="ldk">
                        <?php echo $form->labelEx($model, 'name'); ?>:
                        <?php echo $form->textField($model, 'name'); ?>
                        <?php echo $form->error($model, 'name'); ?>
                    </div>
                    <div class="ldk">
                        <?php echo $form->labelEx($model, 'surname'); ?>:
                        <?php echo $form->textField($model, 'surname'); ?>
                        <?php echo $form->error($model, 'surname'); ?>
                    </div>
                    <div class="ldk">
                        <?php echo $form->labelEx($model, 'patronymic'); ?>:
                        <?php echo $form->textField($model, 'patronymic'); ?>
                        <?php echo $form->error($model, 'patronymic'); ?>
                    </div>
                </div>
                <div class="anchor"></div>


            </div>

        </div>
        <?php if ($model->status == 3): ?>
            <div class="tr_t">
                <div class="td_t">
                </div>
                <div class="td_t">
                    <div class="last_b resume__emptyblock">
                        Выберите предметы которые вы припадаете
                        <div class="">
                            <?php foreach ($predmetprepod as $predmet): ?>
                                <?php echo CHtml::link($predmet->predmet_prepod->name, Yii::app()->urlManager->createUrl('/library/predmet', array('id' => $predmet->predmet_id)), array('class' => 'classic')); ?>
                            <?php endforeach; ?>
                        </div>
                        <input type="submit" onclick="Predmetson();return false" value="Закрепить предметы" >
                    </div>
                </div>
            </div>
        <?php endif; ?> 
        <div class="tr_t">
            <div class="td_t">

            </div>
            <div class="td_t">
                <div class="last_b resume__emptyblock">
                    <?php echo $form->labelEx($model, 'private'); ?>:
                    <?php echo $form->textArea($model, 'private'); ?>
                    <?php echo $form->error($model, 'private'); ?>
                </div>
            </div>
        </div>
        <div class="tr_t">
            <div class="td_t">

            </div>
            <div class="td_t">
                <div class="clone_2">
                    <div class="ldk" id="save_but">
                        <?php
                        if (!isset($model->group_id)) {
                            $disabled_w = 'disabled';
                        } else {
                            $disabled_w = '';
                        }
                        ?>
                        <?php echo CHtml::submitButton('Сохранить'); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>






<script>
    (function($) {
        var pasteEventName = ($.browser.msie ? 'paste' : 'input') + ".mask";
        var iPhone = (window.orientation != undefined);

        $.mask = {
            //Predefined character definitions
            definitions: {
                '9': "[0-9]",
                'a': "[A-Za-z]",
                '*': "[A-Za-z0-9]"
            }
        };

        $.fn.extend({
            //Helper Function for Caret positioning
            caret: function(begin, end) {
                if (this.length == 0) return;
                if (typeof begin == 'number') {
                    end = (typeof end == 'number') ? end : begin;
                    return this.each(function() {
                        if (this.setSelectionRange) {
                            this.focus();
                            this.setSelectionRange(begin, end);
                        } else if (this.createTextRange) {
                            var range = this.createTextRange();
                            range.collapse(true);
                            range.moveEnd('character', end);
                            range.moveStart('character', begin);
                            range.select();
                        }
                    });
                } else {
                    if (this[0].setSelectionRange) {
                        begin = this[0].selectionStart;
                        end = this[0].selectionEnd;
                    } else if (document.selection && document.selection.createRange) {
                        var range = document.selection.createRange();
                        begin = 0 - range.duplicate().moveStart('character', -100000);
                        end = begin + range.text.length;
                    }
                    return { begin: begin, end: end };
                }
            },
            unmask: function() { return this.trigger("unmask"); },
            mask: function(mask, settings) {
                if (!mask && this.length > 0) {
                    var input = $(this[0]);
                    var tests = input.data("tests");
                    return $.map(input.data("buffer"), function(c, i) {
                        return tests[i] ? c : null;
                    }).join('');
                }
                settings = $.extend({
                    placeholder: "_",
                    completed: null
                }, settings);

                var defs = $.mask.definitions;
                var tests = [];
                var partialPosition = mask.length;
                var firstNonMaskPos = null;
                var len = mask.length;

                $.each(mask.split(""), function(i, c) {
                    if (c == '?') {
                        len--;
                        partialPosition = i;
                    } else if (defs[c]) {
                        tests.push(new RegExp(defs[c]));
                        if(firstNonMaskPos==null)
                            firstNonMaskPos =  tests.length - 1;
                    } else {
                        tests.push(null);
                    }
                });

                return this.each(function() {
                    var input = $(this);
                    var buffer = $.map(mask.split(""), function(c, i) { if (c != '?') return defs[c] ? settings.placeholder : c });
                    var ignore = false;                     //Variable for ignoring control keys
                    var focusText = input.val();

                    input.data("buffer", buffer).data("tests", tests);

                    function seekNext(pos) {
                        while (++pos <= len && !tests[pos]);
                        return pos;
                    };

                    function shiftL(pos) {
                        while (!tests[pos] && --pos >= 0);
                        for (var i = pos; i < len; i++) {
                            if (tests[i]) {
                                buffer[i] = settings.placeholder;
                                var j = seekNext(i);
                                if (j < len && tests[i].test(buffer[j])) {
                                    buffer[i] = buffer[j];
                                } else
                                    break;
                            }
                        }
                        writeBuffer();
                        input.caret(Math.max(firstNonMaskPos, pos));
                    };

                    function shiftR(pos) {
                        for (var i = pos, c = settings.placeholder; i < len; i++) {
                            if (tests[i]) {
                                var j = seekNext(i);
                                var t = buffer[i];
                                buffer[i] = c;
                                if (j < len && tests[j].test(t))
                                    c = t;
                                else
                                    break;
                            }
                        }
                    };

                    function keydownEvent(e) {
                        var pos = $(this).caret();
                        var k = e.keyCode;
                        ignore = (k < 16 || (k > 16 && k < 32) || (k > 32 && k < 41));

                        //delete selection before proceeding
                        if ((pos.begin - pos.end) != 0 && (!ignore || k == 8 || k == 46))
                            clearBuffer(pos.begin, pos.end);

                        //backspace, delete, and escape get special treatment
                        if (k == 8 || k == 46 || (iPhone && k == 127)) {//backspace/delete
                            shiftL(pos.begin);
                            return false;
                        } else if (k == 27) {//escape
                            input.val(focusText);
                            input.caret(0, checkVal());
                            return false;
                        }
                    };

                    function keypressEvent(e) {
                        if (ignore) {
                            ignore = false;
                            //Fixes Mac FF bug on backspace
                            return (e.keyCode == 8) ? false : null;
                        }
                        e = e || window.event;
                        var k = e.charCode || e.keyCode || e.which;
                        var pos = $(this).caret();

                        if (e.ctrlKey || e.altKey || e.metaKey) {//Ignore
                            return true;
                        } else if ((k >= 32 && k <= 125) || k > 186) {//typeable characters
                            var p = seekNext(pos.begin - 1);
                            if (p < len) {
                                var c = String.fromCharCode(k);
                                if (tests[p].test(c)) {
                                    shiftR(p);
                                    buffer[p] = c;
                                    writeBuffer();
                                    var next = seekNext(p);
                                    $(this).caret(next);
                                    if (settings.completed && next == len)
                                        settings.completed.call(input);
                                }
                            }
                        }
                        return false;
                    };

                    function clearBuffer(start, end) {
                        for (var i = start; i < end && i < len; i++) {
                            if (tests[i])
                                buffer[i] = settings.placeholder;
                        }
                    };

                    function writeBuffer() { return input.val(buffer.join('')).val(); };

                    function checkVal(allow) {
                        //try to place characters where they belong
                        var test = input.val();
                        var lastMatch = -1;
                        for (var i = 0, pos = 0; i < len; i++) {
                            if (tests[i]) {
                                buffer[i] = settings.placeholder;
                                while (pos++ < test.length) {
                                    var c = test.charAt(pos - 1);
                                    if (tests[i].test(c)) {
                                        buffer[i] = c;
                                        lastMatch = i;
                                        break;
                                    }
                                }
                                if (pos > test.length)
                                    break;
                            } else if (buffer[i] == test[pos] && i!=partialPosition) {
                                pos++;
                                lastMatch = i;
                            }
                        }
                        if (!allow && lastMatch + 1 < partialPosition) {
                            input.val("");
                            clearBuffer(0, len);
                        } else if (allow || lastMatch + 1 >= partialPosition) {
                            writeBuffer();
                            if (!allow) input.val(input.val().substring(0, lastMatch + 1));
                        }
                        return (partialPosition ? i : firstNonMaskPos);
                    };

                    if (!input.attr("readonly"))
                        input
                    .one("unmask", function() {
                        input
                        .unbind(".mask")
                        .removeData("buffer")
                        .removeData("tests");
                    })
                    .bind("focus.mask", function() {
                        focusText = input.val();
                        var pos = checkVal();
                        writeBuffer();
                        setTimeout(function() {
                            if (pos == mask.length)
                                input.caret(0, pos);
                            else
                                input.caret(pos);
                        }, 0);
                    })
                    .bind("blur.mask", function() {
                        checkVal();
                        if (input.val() != focusText)
                            input.change();
                    })
                    .bind("keydown.mask", keydownEvent)
                    .bind("keypress.mask", keypressEvent)
                    .bind(pasteEventName, function() {
                        setTimeout(function() { input.caret(checkVal(true)); }, 0);
                    });

                    checkVal(); //Perform initial check for existing values
                });
            }
        });
    })(jQuery);

</script>