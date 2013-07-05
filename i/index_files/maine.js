function goSpiner(){
    var opts = {
        lines: 13, // The number of lines to draw
        length: 7, // The length of each line
        width: 3, // The line thickness
        radius: 14, // The radius of the inner circle
        corners: 1, // Corner roundness (0..1)
        rotate: 0, // The rotation offset
        color: '#000', // #rgb or #rrggbb
        speed: 0.9, // Rounds per second
        trail: 60, // Afterglow percentage
        shadow: false, // Whether to render a shadow
        hwaccel: false, // Whether to use hardware acceleration
        className: 'spinner', // The CSS class to assign to the spinner
        zIndex: 2e9, // The z-index (defaults to 2000000000)
        top: 'auto', // Top position relative to parent in px
        left: 'auto' // Left position relative to parent in px
    };
    var target = document.getElementById('foo');
    var spinner = new Spinner(opts).spin(target);
    loader.show();
}
function hideSpiner(){
    loader.hide();
}
$(window).scroll(function() {
    left_menu = $('.menu_work');
    const_h = 160;
    if($(window).scrollTop()>const_h){
        left_menu.addClass('fixmenu');
    }else{
        left_menu.removeClass('fixmenu');
    }
    
    scroll = $(document).scrollTop();
    if(scroll > $(window).height()){
        $('.up_head').show();  
    } 
    else{
        $('.up_head').hide();  
    }
    
});

$(function(){
    loader =$('#ajax_loader');
    left_menu = $('.menu_work');
    $('.up_head').click(function(){
        $('html, body').scrollTo( 0, 1500, {
            queue:true
        } );
    })
    $("#search input").focus(function () {
        $(this).siblings('label').hide();
    });
    $("#search input").blur(function () {
        $(this).siblings('label').show();
    });
    
});

function EnterSite(){
    goSpiner();
    $('.this_vhod').hide();
    $.ajax({
        url:'/site/PreLogin',
        type: 'POST',
        dataType: 'json',
        success: function(data){
            $('.title_door h1').text('Вход на сайт');
            openDoor(data.div);
            hideSpiner();
        }
    }); 
}
function openTab(tab){
    $('.ent-razdel').hide();
    $('.ent-razdel[tab='+tab+']').show();
   
} 
function getProfile(profile_id,group_id){
    goSpiner();
    $.ajax({
        url:'/user/ViewStudent',
        type: 'POST',
        dataType: 'json',
        data:({
            'profile_id':profile_id,
            'group_id':group_id
        }),
        success: function(data){
            $('.title_door h1').text('Просмотр студента');  
            openDoor(data.div);
           
            new AmChartsGrap(data.chartData, data.graphs, data.options);
    
            hideSpiner();
        }
    }); 
}

function prepearStudent(){
    var count = 0;
    $('#student_compare .table_t .tr_t .td_t input:checked').each(function(){    
        count++;    
    });
    if (count>1 && count<17) 
        compareStudent();
    else if (count<2) 
        alert('Для сравнения необходимо выбрать минимум 2 студента');  
    else if (count>16) 
        alert('Максимальное количество студентов для сравнения - 32');  
}
function compareStudent(){
    goSpiner();
    $.ajax({
        url:'/user/CompareStudent',
        type: 'POST',
        dataType: 'json',
        data: $('#student_compare').serialize(),
        success: function(data){
            $('.title_door h1').text('Сравнение студентов');  
            openDoor(data.div);
            new AmChartsGrap(data.chartData, data.graphs, data.options);
            hideSpiner();
        }
    });
}
function getUserForm(){
    goSpiner();
    $('.delet_attr_click').attr('onclick','');
    $('#isept').attr('checked','checked');
    $('#isept').attr('disabled','disabled');
    $.ajax({
        url:'/site/UserNew',
        type: 'POST',
        dataType: 'json',
        data:  $("#test_spy").serialize(),
        success: function(data){
            if(data!= null){
                hideSpiner();
                $('#hippodrome .step2').hide( "slide", {
                    direction: "up"
                }, 1000, callback );
                $('.step3').html(data.div);
                $('.shag ul li').removeClass('active');
                $('.shag ul li:nth-child(2)').addClass('edvise');
                $('.shag ul li:nth-child(3)').addClass('active');
            }
        }
    });
    function callback(){
        $('.step3').show( "slide", {
            direction: "down"
        }, 1000 );
    }
    
}
function contineRegistration(){
    $('.inp_sub').addClass('loading');
    $.ajax({
        url:'/site/spy',
        type: 'POST',
        dataType: 'json',
        data:  $("#test_spy").serialize(),
        success: function(data){
            if( data.status == "failure"){
                $('.inp_sub').removeClass('loading');
                $('#hippodrome .step1').hide( "slide", {
                    direction: "down"
                }, 1000, callbackshmek );
                $('.shag ul li').removeClass('active');
                $('.shag ul li:nth-child(1)').addClass('eror_shag');
            }else if(data.status == "failure_ww"){
                $('.inp_sub').removeClass('loading');
                alert('Пожалуста ответьте на последний вопрос');
            }
            else if(data.status == "failure_ee"){
                $('.inp_sub').removeClass('loading');
                alert('Пожалуста ответьте на второй вопрос');
            }
            else if(data.status == "failure_cat"){
                $('.inp_sub').removeClass('loading');
                alert('Пожалуста ответьте на первый вопрос');
            }else{
                $('.inp_sub').removeClass('loading');
                $('#hippodrome .step1').hide( "slide", {
                    direction: "up"
                }, 1000, callback );
                $('.step2').html(data.div);
                $('.shag ul li').removeClass('active');
                $('.shag ul li:nth-child(1)').addClass('edvise');
                $('.shag ul li:nth-child(2)').addClass('active');
            }
        }
    });
    function callback() {
        $('.step2').show( "slide", {
            direction: "down"
        }, 1000 );
    };
    function callbackshmek() {
        $('.step0').show( "slide", {
            direction: "up"
        }, 1000 );
    };
    
}
function retryReg(){
    $('#hippodrome .step0').hide( "slide", {
        direction: "up"
    }, 1000, calbackasd );
    function calbackasd() {
        $('.step1').show( "slide", {
            direction: "down"
        }, 1000 );
    };
    $('.shag ul li:nth-child(1)').addClass('active');
}
function ObjectRating(type,object_id,value){
    goSpiner();
    $.ajax({
        url:'/user/ObjectRating',
        type: 'POST',
        dataType: 'json',
        data:({
            'type':type,
            'object_id':object_id,
            'value':value
        }),
        success: function(data){
            hideSpiner();
            if (data.status == 'failure'){
                text = 'Произошла ошибка';
                notice_class = '3';
            }else if(data.status == 'voted'){
                text = 'Вы уже голосовали, нельзя отменить или поменять голос';
                notice_class = '2';
            }else if(data.status == 'success'){
                    
                if(type == 1){
                    model = $('#c'+object_id+' .object_rating .object_state');
                }else if(type == 3){
                    model = $('#sp_'+object_id+' .object_rating .object_state');
                }else if(type == 2){
                    model = $('#inf_'+object_id+' .voting .mark .score');
                }
                model.removeAttr('class');
                model.addClass('score')
                if(data.this_rating > 0){
                    model.addClass('poloj')
                }else if(data.this_rating < 0){
                    model.addClass('otr')
                }
                
                if(data.this_rating < 0){
                    model.html(data.this_rating); 
                }else if(data.this_rating > 0){
                    model.html('+'+data.this_rating); 
                }
                
                text = 'Ваш голос учтен';
                notice_class = '1';
                
            }
            else if(data.status == 'not_himself'){
                text = 'Нельзя голосовать за себя';
                notice_class = '3';
            }
            noticeOpen(text,notice_class )
            
          
        }
    }); 
    
}
function noticeOpen(text, notice_class){
    $('#notice .notice_text').html('');
    $('#notice').hide();
    
    $('#notice').removeAttr('class');
    if(text == undefined || text == ''){
        text = 'Что то пошло не так..'
    }
    if(notice_class == 1){//green
        add_notice_class = 'notice_block_green';
    }else if(notice_class == 2){//yellow
        add_notice_class = 'notice_block_yellow';
    }else if(notice_class == 3){//red
        add_notice_class = 'notice_block_red';
    }else{
        add_notice_class = 'notice_block_yellow';
    }
    $('#notice').addClass(add_notice_class);
    $('#notice .notice_text').html(text);
    $('#notice').show();
    $('#notice').animate({
        opacity: "0.9"
    }, 500 );
    setTimeout('noticeHide()',5000);
}
function noticeHide(){
    $('#notice').animate({
        opacity: "0"
    }, 500, removeblock );
}
function removeblock(){
    $('#notice .notice_text').html('');
    $('#notice').hide();
}
function createPredmeDuy(weekday_id){
    goSpiner();
    text = 'Пара успешно добавлена';
    $.ajax({
        url:'/user/NewScheduleDay',
        type: 'POST',
        dataType: 'json',
        data:({
            'weekday_id':weekday_id
        }),
        success: function(data){
            $('.sost_day_'+weekday_id).append(data.div);
            noticeOpen(text, '1');
            hideSpiner();
        }
    });
}
function deletePair(schedule_id){
    goSpiner();
    text = 'Пара удалена';
    $.ajax({
        url:'/user/DeleteScheduleDay',
        type: 'POST',
        dataType: 'json',
        data:({
            'schedule_id':schedule_id
        }),
        success: function(data){
            hideSpiner();
            $('#day_schesule_'+schedule_id).hide();
            $('#day_schesule_'+schedule_id).remove();
            if(data.status == 'success'){
                noticeOpen(text, '3');
            }
        }
    });
}
function NewSmallPost(){
    $('#new_obs').addClass('loading');
    content_small_post = $('#disifen').val();
    text1 = 'Обсуждение добавлено';
    text2 = 'Поле пустое';
    
    $.ajax({
        url:'/user/NewSmallPost',
        type: 'POST',
        dataType: 'json',
        data:({
            'content_small_post':content_small_post
        }),
        success: function(data){
            $('#new_obs').removeClass('loading');
            if(data.status == 'success'){
                $('#disifen').val('');
                noticeOpen(text1, '1');
                $('.small_posts_view').prepend(data.div);
            }else if(data.status == 'falure'){
                noticeOpen(text2, '3');
            }
        }
    });
}
function DeleteSmallPost(sp_id){
    goSpiner();
    text = 'Обсуждение удалено'
    $.ajax({
        url:'/user/DeleteSmallPost',
        type: 'POST',
        dataType: 'json',
        data:({
            'sp_id':sp_id
        }),
        success: function(data){
            hideSpiner();
            if(data.status == 'success'){
                $('#sp_'+sp_id).remove();
                noticeOpen(text, '1');
            }
        }
    });
}
function DeleteSPComment(id_sp_comment){
    goSpiner();
    text = 'Комментарий удален'
    $.ajax({
        url:'/user/DeleteSPComment',
        type: 'POST',
        dataType: 'json',
        data:({
            'id_sp_comment':id_sp_comment
        }),
        success: function(data){
            hideSpiner();
            if(data.status == 'success'){
                $('#lkasd_'+id_sp_comment).remove();
                noticeOpen(text, '1');
            }
        }
    });
    
    
}
function zamenaTextArea(small_post_id){
    $('#ncp_'+small_post_id).hide();
    $('#ncr_'+small_post_id).show();
    $('#ncr_'+small_post_id+' .div_textare').focus();
}
function getBackCom(small_post_id){
       
    if($('#dt_'+small_post_id).text() == ''){
        $('#ncr_'+small_post_id).hide();
        $('#ncp_'+small_post_id).show();
    }
}




function newSmallPostComment(small_post_id,el){
    content = el.siblings('.div_textare').html();
    el.addClass('loading');
    $.ajax({
        url:'/user/newSmallPostComment',
        type: 'POST',
        dataType: 'json',
        data:({
            'small_post_id':small_post_id,
            'content':content
        }),
        success: function(data){
            el.siblings('.div_textare').text('')
            el.removeClass('loading');
            if(data.status == 'success'){
                $('#sp_id_fo_com_'+data.sp_id).append(data.div);
            }
        }
    });
}
function showComment(el, id){
    el.hide();
    el.siblings('.hide_com').show();
    $('#sp_id_fo_com_'+id+' .hide_c').show();
}
function hideComment(el, id){
    el.hide();
    el.siblings('.show_com').show();
    $('#sp_id_fo_com_'+id+' .hide_c').hide();
}

function keyDown(type_id,dis_id, e){
    if(e.keyCode == 17){
        ctrl = true;
    }
    else if(e.keyCode == 13 && ctrl){
        if(type_id == 1){
            if(dis_id == 0){
                alert('Создать новый пост');
            }
                
        }else if(type_id == 2){
            alert('Создать коммент для поста');
        }
        
        
        ctrl = false;
    }
}
function keyUp(e){
    if(e.keyCode == 17){
        ctrl = false;
    }
}
function recoverpassword(el){
    login =el.siblings('input').val()
    if(login != ''){
        el.addClass('loading');
        $.ajax({
            url:'/site/RecoveryPassword',
            type: 'POST',
            dataType: 'json',
            data:({
                'login':login
            }),
            success: function(data){
                el.siblings('input').val()
                el.removeClass('loading');
                if(data.status == 'failure'){
                    text = "Нет такого адреса эл.почта"
                    noticeOpen(text, '3');
                }else if(data.status == 'seccess'){
                    $('.recoverypassword .resume__emptyblock').html('');
                    $('.recoverypassword .resume__emptyblock').append(data.div);
                }
            }
        });
    }else{
        alert('Введите адрес');
    }
}
function deletePicterPost(id, el){
    goSpiner();
    $.ajax({
        url:'/post/DeletePicterPost',
        type: 'POST',
        dataType: 'json',
        data:({
            'id':id
        }),
        success: function(data){
            if(data.status == 'success'){
                el.parent().remove();
                $('.uload_list li.file_id_'+id).remove();
                $('.uload_list_img li.file_id_'+id).remove();
                $('input.file_id_'+id).remove();
                text = "Удалено"
                noticeOpen(text, '1');
            }else if(data.status == 'failure'){
                text = "Ошибка"
                noticeOpen(text, '3');
            }
            hideSpiner();
        }
    });
}
function deleteFileGroup(id, el){
    goSpiner();
    $.ajax({
        url:'/user/deleteFileGroup',
        type: 'POST',
        dataType: 'json',
        data:({
            'id':id
        }),
        success: function(data){
            if(data.status == 'success'){
                el.parent().hide();
                $('.uload_list li.file_id_'+id).remove();
                $('input.file_id_'+id).remove();
                text = "Удалено"
                noticeOpen(text, '1');
            }else if(data.status == 'failure'){
                text = "Ошибка"
                noticeOpen(text, '3');
            }
            hideSpiner();
        }
    });
}
function MaineSearch(el){
    $.ajax({
        url:'/site/Search',
        type: 'POST',
        dataType: 'json',
        data:({
            'search': el.siblings('input').val()
        }),
        success: function(data){
           
        }
    });
}
function uploadStats(profile_id){
    $.ajax({
        url:'/user/Stats',
        type: 'POST',
        dataType: 'json',
        data:({
            'profile_id':profile_id
        }),
        success: function(data){
            $('.stats_box').append(data.div);
        }
    })
}
function changeStats(el){
    el.addClass('loading');
    $.ajax({
        url:'/user/Stats',
        type: 'POST',
        dataType: 'json',
        data: $('#user_stats').serialize(),
        success: function(data){
            if(data.status == 'success'){
                text = 'Изменения сохранены';
                noticeOpen(text, 1);
            }
            el.removeClass('loading');
        }
    })
}
function newfilegroup(){
    $(".cloud_file_up").animate({
        opacity:0.9,
        top: "50px"
    }, 1500 );
}
function ClearFileGroup(el){
    $(".cloud_file_up").animate({
        top: "350px",
        opacity:0
    }, 1500 );
//    function calback(){
//        el.parent().remove();
//    }
    
}
