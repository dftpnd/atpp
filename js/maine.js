/*====*/
var notice_green = '1';
var notice_yellow = '2';
var notice_red = '3';
/*====*/


send = {};
send['start_async_page'] = '';





var dataLocation = new Object();
dataLocation.event = function(href){

  if(this.nowUrl != '')
    this.lasteUrl = this.nowUrl;
  
  this.nowUrl = href;
  
  var params = [];
  params['title'] = $('title').html();
  params['href'] = href;
  
  this.urlHistory[this.urlHistory.length++] = params;
  
    
}
dataLocation.nowUrl = '' 
dataLocation.lasteUrl = ''; 
dataLocation.urlHistory = [];


window.addEventListener('popstate', function(e){
  if(typeof e.state == "undefined")
    if(typeof e.state.url == "undefined")
      changePage(e.state.url, false);
}, false);
  
  
$('a').live('click',function(event){
  
  if($(this).attr('async') != undefined ){
    
    closeContent();
    
    handlerAnchors($(this).attr('href'));
    return false;
  }
});

function handlerAnchors(href) {

  
  var href_inner = href+"";
    
  if(send['start_async_page'] == 'send')
    return false;
  
  
  send['start_async_page'] = 'send';
            
    
  if($.browser.msie){
    window.location = href;
    return false;
  }        
  
  changePage(href_inner, true);
}
function changePage(url, history_push){
    
  if(history_push == undefined)
    history_push = false;  
  
  dataLocation.event(url);
    
  $.ajax({
    type: "POST",
    async: false,
    url: url,
    dataType: "json",
    data:({
      'async':'async'
    }),
    success: function(data){
      if(data != null){
        openContent();
        if(data.status == 'success'){
                                        
          $('#content').html(data.data);
          $('title').text(data.title);                    
                    
          if(history_push)
            history.pushState( {
              title: data.title, 
              url: url
            }, data.title, url );
                    
          
          send['start_async_page'] = 'sender';
          send['send_infinity_scroll'] = {}; 
          
          if(history_push){
            $(document).scrollTop('0');
            scroll = 0;
          }  
          
        } 
      }else{
        alert('Ошибка. Попробуйте перезагрузить страницу.');
      } 
    }
  });
}
function parseGetParams() { 
  var $_GET = {}; 
  var __GET = window.location.search.substring(1).split("&"); 
  for(var i=0; i<__GET.length; i++) { 
    var getVar = __GET[i].split("="); 
    $_GET[getVar[0]] = typeof(getVar[1])=="undefined" ? "" : getVar[1]; 
  } 
  return $_GET; 
} 
function closeContent(){
  $('.content_loader').show();
  $('#content').addClass('clouset');
   
};
function openContent(){
  $('#content').removeClass('clouset');
  $('.content_loader').hide();
};
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
function goGear(){
  $('.float_signal').addClass('gear');
}
function spotGear(){
  $('.float_signal').removeClass('gear');
}
$(window).scroll(function() {
  left_menu = $('.menu_work');
  const_h = 280;
  if($(window).scrollTop()>const_h){
    left_menu.addClass('fixmenu');
  }
  else{
    left_menu.removeClass('fixmenu');
  }
    
  var scroll = $(document).scrollTop();
    
    
    
  if(scroll > $(window).height()){
    $('.up_head').show();  
  } 
  else{
    $('.up_head').hide();  
  }
    
  if($('#yaokor').length !== 0 ){  
    var up_head = $('.up_head').offset().top +210;
    var yakor = $('#yaokor').offset().top;
    if(yakor < up_head)
      $('.up_head').css('margin-bottom','200px')
    else
      $('.up_head').css('margin-bottom','0')
  }
  
  
  fs = $('.float_signal');
  if( fs.length !== 0 ){
    fs.scrollTop();
    sum_t = $('.float_signal').offset().top - 1000 ;
    if(sum_t < scroll ){
      if(fs.attr('zapros') != 'active'){
        if(fs.attr('the') != 'end'){
          goGear();
          var dis_count = $(".small_posts_view > div.view_small_post").length;
          fs.attr('zapros','active');
          $.ajax({
            url:window.location,
            type: 'POST',
            dataType: 'json',
            data:({
              'dis_count':dis_count
            }),
            success: function(data){
              fs.removeAttr('zapros');
              $('.small_posts_view').append(data.div);
              if(data.count < 5){
                fs.attr('the','end');
              }
              spotGear();
            }
          }); 
        }
      }
    }
  };
   
});
$(window).resize(function() {
    
  });
  
$(function(){
  
  loader = $('#ajax_loader');
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
  $('#light_bulb').hover(
    function () {
      $('.light_bulb_hint').show();
    }
    );
  $('.light_bulb_hint').mouseout(function(){
    $('.light_bulb_hint').hide();
  });
   
  $('.menu li').click(function(){
    $('.menu li').removeClass('active');
    $(this).addClass('active');
  })
   
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
function prepearGroup(){
  var count = 0;
  $('.table_t .tr_t .td_t input:checked').each(function(){    
    count++;    
  });
  if (count>1 && count<17) 
    compareGroup();
  else if (count<2) 
    alert('Для сравнения необходимо выбрать больше одной группы');  
  else if (count>16) 
    alert('Максимальное количество групп для сравнения - 10');  
}
function prepearStudent(){
  var count = 0;
  $('#student_compare input:checked').each(function(){    
    count++;    
  });
  if (count>1 && count<17) 
    compareStudent();
  else if (count<2) 
    alert('Для сравнения необходимо выбрать минимум 2 студента');  
  else if (count>32) 
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
function compareGroup(){
  goSpiner();
  $.ajax({
    url:'/reestr/CompareGroup',
    type: 'POST',
    dataType: 'json',
    data: $('#student_group').serialize(),
    success: function(data){
      $('.title_door h1').text('Сравнение групп');  
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
        }else if(type == 4){
          model = $('#sp_'+object_id+' .object_rating .object_state');
        }else if(type == 5){
          model = $('#prepod_file_'+object_id+' .object_state');
        }else if(type == 6){
          model = $('#sp_'+object_id+' .object_rating .object_state');
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
    opacity: "0.7"
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

function DeleteSmallPost(sp_id,type, pin){
  goSpiner();
  text = 'Обсуждение удалено'
  $.ajax({
    url:'/user/DeleteSmallPost',
    type: 'POST',
    dataType: 'json',
    data:({
      'sp_id':sp_id,
      'type':type,
      'pin':pin
    }),
    success: function(data){
      if(data.status == 'success'){
        $('#sp_'+sp_id).remove();
        noticeOpen(text, '1');
      }else{
        noticeOpen('Ошибка', '3');
      }
    },
    complete:function(data){
      hideSpiner();
    }
  });
}
function DeleteSPComment(id_sp_comment,type, pin){
  goSpiner();
  text = 'Комментарий удален'
  $.ajax({
    url:'/user/DeleteSPComment',
    type: 'POST',
    dataType: 'json',
    data:({
      'id_sp_comment':id_sp_comment,
      'type':type,
      'pin':pin
    }),
    success: function(data){
      if(data.status == 'success'){
        $('#lkasd_'+id_sp_comment).remove();
        noticeOpen(text, '1');
      }else if(data.status == 'falure'){
        noticeOpen('Произошла ошибка', '2');
      }
    },
    complete:function(data){
      hideSpiner();
    }
  });
    
    
}
function zamenaTextArea(small_post_id, type){
  $('#ncp_'+small_post_id).hide();
  $('#ncr_'+small_post_id).show();
  $('#ncr_'+small_post_id+' .div_textare').focus();
  $('#ncr_'+small_post_id+' .div_textare').keypress(function(e) {
    if(e.which == 13) {
      newSmallPostComment(small_post_id, $('#ncr_'+small_post_id+' .inp_sub'),type)
    }
  }); 
}
function getBackCom(small_post_id){
       
  if($('#dt_'+small_post_id).text() == ''){
    $('#ncr_'+small_post_id).hide();
    $('#ncp_'+small_post_id).show();
  }
}




function newSmallPostComment(small_post_id,el,type){
  content = htmlDecode(el.siblings('.div_textare').html());
  
  
  el.addClass('loading');
  $.ajax({
    url:'/user/newSmallPostComment',
    type: 'POST',
    dataType: 'json',
    data:({
      'small_post_id':small_post_id,
      'content':content,
      'type':type
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
          text = "Пользователь с таким электронным адресом не зарегистрирован"
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
function uploadPredmetGroup(group_id){
  $.ajax({
    url:'/reestr/PredmetGroup',
    type: 'POST',
    dataType: 'json',
    data:({
      'group_id':group_id
    }),
    success: function(data){
      $('.stats_box').append(data.div);
    }
  })
}
function getschedule(group_id){
  $.ajax({
    url:'/reestr/getschedule',
    type: 'POST',
    dataType: 'json',
    data:({
      'group_id':group_id
    }),
    success: function(data){
      $('.stats_box').append(data.div2);
    }
  })
}
function changeStats(el, user_id){
  el.addClass('loading');
  $.ajax({
    url:'/user/Stats?user_id'+user_id,
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
  $('.fixed_panel_for_close').show();
  $(".cloud_file_up").animate({
    opacity:0.9,
    top: "50px"
  }, 1500 );
}
function ClearFileGroup(el){
  $('.fixed_panel_for_close').hide();
  $(".cloud_file_up").animate({
    top: "-700px",
    opacity:0
  }, 1500 );
  
}
function OblastVid(id,el){
  $('#gf_obl').val(id);
  el.attr('active','active');
  el.css('cursor','default')
  el.siblings('.box_oblast').hide();
  el.animate({
    left: "40px",
    width: "20px",
    height: "20px",
    margin: "20px 0 0 0"
  }, 500, feedback );
  
  function feedback(){
    $('.box_oblast').attr('onclick','');
    $('.oblast_vid').text('Можете оставить коментарий:');
    $('.bacground_comment_to_file').show();
    $('.comment_to_file').show();
    $('.manage_file_but').show();
  }
}
function prevBut(el){
  
  $('.next_but').show();
  if($('.bacground_comment_to_file').attr('title') == undefined){
    
    $('.box_oblast').css('cursor','pointer')
    ch_id = $('.box_oblast[active = "active"]').attr('ch_id');
    $('.box_oblast[active = "active"]').removeAttr('active')
    if(ch_id == '1'){
      left_pos = '40';
    }else if(ch_id == '2'){
      left_pos = '180';
    }else if(ch_id == '3'){
      left_pos = '330';
    }
    function feedback(){
      $('.comment_to_file').hide();
      $('.tern_1').attr('onclick','OblastVid(1, $(this))');
      $('.tern_2').attr('onclick','OblastVid(2, $(this))');
      $('.tern_3').attr('onclick','OblastVid(3, $(this))');
      $('.box_oblast').show();
    }
    
    $('.oblast_vid').text('Выберите область видимости файла:');
    //$('.comment_to_file').hide();
    
    $('.bacground_comment_to_file').hide();
    $('.bacground_comment_to_file').css({
      width: "60px",
      height: "60px",
      top: "273px",
      margin: "0 0 0 0",
      right: "47px"
    });
    $('.comment_to_file').hide();
    $('.manage_file_but').hide();
  
    $('.tern_'+ch_id).animate({
      left: left_pos+'px',
      width: "60px",
      height: "60px",
      margin: "40px 0 0 0"
    }, 500, feedback );
    
  }else{
    $('.prev_but').removeAttr('onclick');
    $('.u_f_g').hide();
    $('.oblast_vid').text('Можете оставить коментарий:');
    function feedback2(){
      $('.comment_to_file').show();
      $('.prev_but').attr('onclick','prevBut($(this))');
    }
    $('.bacground_comment_to_file').removeAttr('title')
    $('.bacground_comment_to_file').animate({
      width: "60px",
      height: "60px",
      top: "273px",
      margin: "0 0 0 0",
      right: "47px"
    }, 500,feedback2 );
  }
  
  
}
function nextBut(el){
  if($('.bacground_comment_to_file').attr('title') == undefined){
    
    el.hide();
    function feedback(){
      $('.u_f_g').show();
    }
    $('.oblast_vid').text('Теперь можно загрузить сам файл:');
    text = $('.comment_to_file textarea').val();
    $('#gf_comment').val(text);
    $('.comment_to_file').hide();
    $('.bacground_comment_to_file').animate({
      width: "30px",
      height: "30px",
      top: "186px",
      margin: "20px 0 0 0",
      right: "350px"
    }, 500, feedback );
    if( text == ''){
      $('.bacground_comment_to_file').attr('title','без коментария')
    }else if( text != ''){
      $('.bacground_comment_to_file').attr('title', text)
    }
  }else{
    
  }
}
function LoadFile(el){
  //    el.attr('disabled','disabled');
  //    el.siblings('input[type="file"]').attr('disabled','disabled');
  el.addClass('loading');
}
function ieblokad(){
  $.ajax({
    url:'/site/ieblokad',
    type: 'POST',
    dataType: 'json',
    data: $('#user_stats').serialize(),
    success: function(data){
      if(data.div){
        $('.oshib').append(data.div);
        $('.oshib').show();
        $('.oshib').animate({
          top: "0px"
        }, 1000 );
      }
    }
  })

}
function ClassmateBlokked(profile_id, el){
  if (confirm("Это важое решение, тот кого вы заморозите, не сможет зайти на сайт! Вы уверенны?")){
    goSpiner();
    $.ajax({
      url:'/user/ClassmateBlokked',
      type: 'POST',
      dataType: 'json',
      data:({
        'profile_id':profile_id
      }),
      success: function(data){
        hideSpiner();
      }
    });
  }
}
function getActiveDay(active_day){
  if(active_day != '7'){
    el = $('.dc_'+active_day);
    el.append('<div class="today_now">Сегодня</div>');
  }else{
  //воскресенье
  }
  
}
function getWeek(active_week){
  $('#radio'+active_week).attr('checked','checked');
  if(active_week == '1'){
    getAllWeek();
  }else if(active_week == '3'){
    getChetWeek();
  }else if(active_week == '2'){
    getNeChetWeek();
  }
    
}
function getAllWeek(){
  $('.show_class_1').css('opacity','1');
  $('.show_class_2').css('opacity','1');
  $('.show_class_3').css('opacity','1');
}
function getChetWeek(){
  $('.show_class_1').css('opacity','1');
  $('.show_class_2').css('opacity','0.2');
  $('.show_class_3').css('opacity','1');
}
function getNeChetWeek(){
  $('.show_class_1').css('opacity','1');
  $('.show_class_2').css('opacity','1');
  $('.show_class_3').css('opacity','0.2');
    
}
function ChangeMonth(where_id){
  goSpiner();
  mounth = $('.old_val_mounth').val();
  year = $('.old_val_year').val();
  $.ajax({
    url:'/site/ChangeMonth',
    type:'POST',
    dataType: 'json',
    data:({
      'where_id':where_id,
      'mounth':mounth,
      'year':year
    }),
    success: function(data){
      $('.mounth_box').html(data.div)
      hideSpiner();
      $('.old_val_mounth').val(data.mounth)
      $('.old_val_year').val(data.year)
      showToltip();
    }
  })
}
function showToltip(){
  if($('.activ_day').length !== 0){
    $('.activ_day').mouseover(function () {
      $(this).siblings('.activity_hint').show();
    });
    $('.activ_day').mouseout(function(){
      $(this).siblings('.activity_hint').hide();
    })
    $('.activ_day').click(function(){
      alert('asdasd');
    })
  }
}

function pred_activity(el){
  $('.one_activity_view').show();
  $('.bloc_1').show();
  $('.bloc_2').hide();
  step_1(el);
  step_2(el);
}
function step_1(el){
  if(el.parent().attr('class') == 'bloc_1'){
    $('.one_activity_edit').hide();
    el.parent().siblings('.one_activity_view').hide();
    el.parent().siblings('.one_activity_edit').show();
  }else{
    $('.one_activity_edit').hide();
  }
}
function step_2(el){
  el.parent().hide();
  if(el.parent().attr('class') == 'bloc_1'){
    el.parent().siblings('.bloc_2').show();
  }else{
    el.parent().siblings('.bloc_1').show();
  }
    
}
function delete_activity(id_activity){
  goSpiner();
  $.ajax({
    url:'/user/DeleteActivity',
    type:'POST',
    dataType: 'json',
    data:({
      'id':id_activity
    }),
    success: function(data){
      noticeOpen('Событие удалено','2');
      hideSpiner();
      $('#vas_'+id_activity).remove();
    }
  })
}
function save_activity(id){
  goSpiner();
  $.ajax({
    url:'/user/SaveActivity',
    type:'POST',
    dataType: 'json',
    data:$('#form_edit_'+id).serialize(),
    success: function(data){
      noticeOpen('Событие удалено','2');
      hideSpiner();
      $('#vas_'+id_activity).remove();
    }
  })
}
function SlideWidth(){
  if(typeof cont_width_slede == 'undefined') 
    cont_width_slede = $(document).width() - ($('.custom-calendar-wrap').width() + $('.menu_work').width());
   
  if( $('.slide').length !== 0 )
    $('.slide').css('width',cont_width_slede+'px');
}
function chengePrdemet(el){
  el.toggleClass('acupent');
}
function Predmetson(){
  goSpiner();
  $.ajax({
    url:'/library/prepodpredmets',
    type:'POST',
    dataType: 'json',
    success: function(data){
      openDoor(data.div);
    },
    complete:function(data){
      hideSpiner();
    }
  })
}
function delet_file_library(el){
  goSpiner();
  var file_id;
  file_id = el.parent().attr('file_id');
  $.ajax({
    url:'/library/deletefile',
    type:'POST',
    data:({
      'file_id':file_id
    }),
    dataType: 'json',
    success: function(data){
      if(data.status == 'good'){
        $('#file_id_'+file_id).hide();
        $('#file_id_'+file_id).remove();
      }
    },
    complete:function(data){
      hideSpiner();
    }
  })
}
function submit_text_predmet(el, predmet_id){
  el.addClass('loading');
  $.ajax({
    url:'/library/EditText',
    type:'POST',
    data:({
      'predmet_id':predmet_id,
      'text':$('.submit_text_predmet_textarea').val()
    }),
    dataType: 'json',
    success: function(data){
      if(data.status == 'good'){
        noticeOpen('Успешно сохранено',1 )
      }else{
        alert('произошла ошибка, попробуйте перезагрузить страницу');
      }
    },
    complete:function(data){
      el.removeClass('loading');
    }
  })
}
function EditList(group_id,semestr_id){
  loader.show();
  $.ajax({
    url:'/userAdmin/admin/EditList',
    type: 'POST',
    dataType: 'json',
    data:({
      'group_id':group_id,
      'semestr_id':semestr_id
    }),
    success: function(data){
      openDoor(data.div);
      if (data.predmets != null)
      {
        for (property  in data.predmets)
        {
          $('.predmet_goupview li#'+data.predmets[property].predmet_id).addClass('acupent').attr('check','check');
        }
      }
      loader.hide();
    }
  });
}
function podobiu(group_id){
  loader.show();
  $.ajax({
    url:'/userAdmin/admin/Podobiu',
    type: 'POST',
    dataType: 'json',
    data:({
      'group_id':group_id
    }),
    success: function(data){
      openDoor(data.div);
      if (data.predmets != null)
      {
        for (property  in data.predmets)
        {
          $('.predmet_goupview li#'+data.predmets[property].predmet_id).addClass('acupent').attr('check','check');
        }
      }
      loader.hide();
    }
  });
}
function deleteStudent(user_id){
  loader.show();
  if (confirm("Вы уверены? Пользователь удалится безвозвратно!")){
    $.ajax({
      url:'/user/DeleteStudent',
      type: 'POST',
      dataType: 'json',
      data:({
        'user_id':user_id
      }),
      success: function(data){
        if(data.status == 'success')
          alert('success')
        else
          alert(data.error)
        loader.hide();
      }
    });
  }
}
function banStudent(user_id){
  loader.show();
  $.ajax({
    url:'/user/BanStudent',
    type: 'POST',
    dataType: 'json',
    data:({
      'user_id':user_id
    }),
    success: function(data){
      if(data.status == 'success')
        alert('success')
      else
        alert(data.error)
      loader.hide();
           
      loader.hide();
    }
  });
}
function razBanStudent(user_id){
  loader.show();
  $.ajax({
    url:'/user/RazBanStudent',
    type: 'POST',
    dataType: 'json',
    data:({
      'user_id':user_id
    }),
    success: function(data){
      if(data.status == 'success')
        alert('success')
      else
        alert(data.error)
      loader.hide();
           
      loader.hide();
    }
  });
}
function changeFolder(folder_id,e){
  
  if (!e) var e = window.event;
  
  e.cancelBubble = true;
  
  if (e.stopPropagation) {
    e.stopPropagation();
  }
 
  loader.show();
  
  var GET = parseGetParams(); 
  if( GET.parent_id === undefined)
    GET.parent_id = 0;
  
  
  
  $.ajax({
    url:'/user/ChangeFolder',
    type: 'POST',
    dataType: 'json',
    data:({
      'folder_id':folder_id,
      'parent_id':GET.parent_id
    }),
    success: function(data){
      if(data.status == 'success'){
        $('.tr_files').removeClass('active');
        $('.table_body_t').prepend(data.html);
        $("#input_name_"+folder_id).focus();
        $("#input_name_"+folder_id).keypress(function(e) {
          if(e.which == 13) {
            saveChangeFolder();
          }
        });
      }else{
        noticeOpen(data.error, notice_red);
      }
      loader.hide();
    }
  });
}
function saveChangeFolder(){
  
  loader.show();
  $.ajax({
    url:'/user/SaveChangeFolder',
    type: 'POST',
    dataType: 'json',
    data: $('.st_new :input').serialize(),
    success: function(data){
      if(data.status == 'success'){
        updateDirectory(data.parent_id, data.author_id);
        noticeOpen('Изменения сохранены', notice_green);
      }else{
        $('.table_body_t .tr_files:first-child').remove();
        noticeOpen(data.error, notice_red);
      }
      loader.hide();
    }
  });
}
function deleteFolder(e){
  e.stopPropagation();
  el = $('.table_files .tr_files.active');
  var name_folder = el.find('.name_folder').val();
  var folder_id = el.attr('folder_id');
  
  if(el.attr('status_attr') == 'file'){
    var status_attr = 'файл';
  }else{
    var status_attr = 'папку';
  }
  
  if(folder_id == undefined){
    alert('Выберите папку или файл');
  }else{
    if (confirm("Вы уверенны что хотите удалить "+status_attr+" «"+name_folder+"»?")){
      loader.show();
      $.ajax({
        url:'/user/DeleteFolder',
        type: 'POST',
        dataType: 'json',
        data: ({
          'folder_id':folder_id
        }),
        success: function(data){
          if(data.status == 'success'){
            $('[folder_id='+folder_id+']').remove();
            noticeOpen('Изменения сохранены', notice_green);
          }else{
            noticeOpen(data.error, notice_red);
          }
          loader.hide();
        }
      });
    }
  }
}
function updateDirectory(parent_id, author_id){
  loader.show();
  $.ajax({
    url:'/user/UpdateDirectory',
    type: 'POST',
    dataType: 'json',
    data: ({
      'parent_id':parent_id,
      'author_id':author_id
    }),
    success: function(data){
      if(data.status == 'success'){
        $('.tr_files').remove();
        $('.table_body_t').append(data.html);
        noticeOpen('Обновлено', notice_green);
      }else{
        noticeOpen(data.error, notice_red);
      }
      loader.hide();
    }
  });
}
function openFolder(el, e){    
  if (!e) var e = window.event;
  
  e.cancelBubble = true;
  
  if (e.stopPropagation) {
    e.stopPropagation();
  }
  
  getOpenFolder(el.parents('.tr_files').attr('folder_id'))
}
$('html').click(function() {
  closeNewFolder();
  $('.ul_files_actions').hide();
  closeDoor();
});

function closeNewFolder(){
  var el = $('.tr_files');
  if(el.length != 0){
    el.removeClass('active');
    $('.ul_files_actions').show();
    if(el.hasClass('st_new')){
      saveChangeFolder();
      el.removeClass('st_new');
      el.addClass(' st_old');
    }
    
  }
}
function activeFolder(el, event){
  closeNewFolder();
  event.stopPropagation();
  el.addClass('active');
}

function getOpenFolder(folder_id){
  loader.show();
  $.ajax({
    url:'/user/OpenFolder',
    type: 'POST',
    dataType: 'json',
    data: ({
      'folder_id':folder_id
    }),
    success: function(data){
      if(data.status == 'success'){
        
        $('.tr_files').remove();
        $('.table_body_t').append(data.html);
        $('#breadcrambs').html(data.html_breadcrambs);
        
        url = '/user/files?id='+data.folder.user_id+'&parent_id='+data.folder.id;
        history.pushState( {
          title: 'файлы', 
          url: url
        }, data.title, url );
  
      }else{
        noticeOpen(data.error, notice_red);
      }
      loader.hide();
    }
  });
}

function editLineFolder(e){
  e.stopPropagation();
  var el = $('.table_files .tr_files.active');
  el.removeClass('st_old');
  el.addClass('st_new');
  var input = $('.table_files .tr_files.active .name_folder');
  
  input.focus();
  input.keypress(function(e) {
    if(e.which == 13) {
      saveChangeFolder();
    }
  }); 
  
}


function editPriveteStatus(event){
  event.stopPropagation();
  saveChangeFolder();
}
function doorDownloadFile(e){
  e.stopPropagation();
  loader.show();
  var GET = parseGetParams(); 
  if( GET.parent_id === undefined)
    GET.parent_id = 0;
  
  $.ajax({
    url:'/user/DoorDownloadFile',
    type: 'POST',
    dataType: 'json',
    data:({
      'parent_id':GET.parent_id
    }),
    success: function(data){
      if(data.status == 'success'){
        openDoor(data.html);
      }else{
        noticeOpen(data.error, notice_red);
      }
      loader.hide();
    }
  });
}

function switchStatisticUser(el){
  el.parents('.resume__emptyblock').toggleClass('show_statistic');
}
function nl2br (str, is_xhtml) {
  // Converts newlines to HTML line breaks  
  //
  // version: 1004.2314
  // discuss at: http://phpjs.org/functions/nl2br    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   improved by: Philip Peterson
  // +   improved by: Onno Marsman
  // +   improved by: Atli Þór
  // +   bugfixed by: Onno Marsman    // +      input by: Brett Zamir (http://brett-zamir.me)
  // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   improved by: Brett Zamir (http://brett-zamir.me)
  // +   improved by: Maximusya
  // *     example 1: nl2br('Kevin\nvan\nZonneveld');    // *     returns 1: 'Kevin\nvan\nZonneveld'
  // *     example 2: nl2br("\nOne\nTwo\n\nThree\n", false);
  // *     returns 2: '<br>\nOne<br>\nTwo<br>\n<br>\nThree<br>\n'
  // *     example 3: nl2br("\nOne\nTwo\n\nThree\n", true);
  // *     returns 3: '\nOne\nTwo\n\nThree\n'    
  var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '' : '<br>';

  return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
}
function validateText(el){
  alert('asd')
}
function htmlEncode(value){
  //create a in-memory div, set it's inner text(which jQuery automatically encodes)
  //then grab the encoded contents back out.  The div never exists on the page.
  return $('<div/>').text(value).html();
}

function htmlDecode(value){
  return $('<div/>').html(value).text();
}

function NewSmallPost(type, belong_id){
  $('#new_obs').addClass('loading');
  content_small_post = htmlDecode($('#disifen').html());
  text1 = 'Обсуждение добавлено';
  text2 = 'Поле пустое';
  
  $.ajax({
    url:'/user/NewSmallPost',
    type: 'POST',
    dataType: 'json',
    data:({
      'content_small_post':content_small_post,
      'type':type,
      'belong_id':belong_id
    }),
    success: function(data){
      $('#new_obs').removeClass('loading');
      if(data.status == 'success'){
        $('#disifen').val('');
        $('#disifen').html('');
        noticeOpen(text1, '1');
        $('.small_posts_view').prepend(data.div);
      }else if(data.status == 'falure'){
        noticeOpen(text2, '3');
      }
    }
  });
}