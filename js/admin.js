function groupList(id){
    loader.show();
    $.ajax({
        url:'/userAdmin/admin/GroupUsers',
        type: 'POST',
        dataType: 'json',
        data:({
            'id':id
        }),
        success: function(data){
            openDoor(data.div);
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
function infogroup(group_id){
    loader.show();
    $.ajax({
        url:'/userAdmin/admin/infogroup',
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
function saveInfogroup(){
    loader.show();
    $.ajax({
        url:'/userAdmin/admin/saveInfogroup',
        type: 'POST',
        dataType: 'json',
        data: $('#infogroup').serialize(),
        success: function(data){
            if(data.status == 'good'){
                closeDoor();
            }else if(data.status == 'bad'){
                alert('Произошла ошибка');
            }else{
                alert('Произошла ошибка');
            }
            loader.hide();
        }
    });
}
function deleteInstitute(el, intitute_id){
    loader.show();
    $.ajax({
        url:'/userAdmin/admin/deleteInstitute',
        type: 'POST',
        dataType: 'json',
        data: ({
            'intitute_id':intitute_id
        }),
        success: function(data){
            el.parent().hide();
            loader.hide();
        }
    });
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
function chengePrdemet(el){
    el.toggleClass('acupent');
}
function deleteUser(user_id, profile_id){
    $.ajax({
        url:'/userAdmin/admin/DeleteUser',
        type: 'POST',
        dataType: 'json',
        data:({
            'user_id':user_id,
            'profile_id':profile_id
        }),
        success: function(data){
            if(data.status == 'good')
                $('#user_'+user_id).remove();
        }
    });
}
$(document).ready(function () {
    loader =$('#ajax_loader');
  
  
  
    $('.tabnav-tab').bind('click', function() {
    
        });
    //delete
  
  
    $('.pendulum').click(function() {
        predmet_id = $(this).attr('predmet_id');
        title = $(this).attr('title');
        if (confirm("Удалить "+title+"?")) {
            $.ajax({
                type: "POST",
                url: "DeletePredmet",
                data: {
                    predmet_id : predmet_id
                },
                success: function(data){                                                       
                    if(data == "1"){
                        $('.predet_generat tr.predet_id_'+predmet_id).hide();
                    }
                }
            });
        } 
    });
    //delete
  
    //update
    $('.save').click(function() {
    
        predmet_id = $(this).attr('predmet_id');
        value = $('#id_input_'+predmet_id).attr('value');
    
        $.ajax({
            type: "POST",
            url: "UpdatePredmet",
            data: {
                predmet_id : predmet_id, 
                value : value
            },
            success: function(data){                                                       
                if(data == "1"){
                    $('.predmet_name_inp').hide();
                    $('.otmena').hide();
                    $('.save').hide();
                    $('.premet_name').show();
                    $('#span_id_'+predmet_id).html(value);
                    $('.pendulum').show();
                    $('.ediat_premet').show();
                }
            }
        });
  
  
    });
    //update
  
    $('.ediat_premet').click(function() {
        $('.pendulum').show();
        $(this).siblings('.pendulum').hide();
        $('#span_id_'+$(this).attr('id_input')).hide();
        $('.predmet_name_inp').hide();
        $('.otmena').hide();
        $('.save').hide();
        //        $('.premet_name').show();
        id_input = $(this).attr('id_input');
        $(this).hide();
    
        $('#id_input_'+id_input).show();
        $('#id_input_save_'+id_input).show();
        $('#id_input_otm_'+id_input).show();
  
    });
    $('.otmena').click(function() {
        $('.ediat_premet').show();
        $('.pendulum').show();
        id_input = $(this).attr('id_input');
        $('#id_input_'+id_input).hide();
        $('#id_input_save_'+id_input).hide();
        $('#id_input_otm_'+id_input).hide();
        $('.premet_name').show();
    });
  
  
  
    //premet <=============================================================================
  
  
  
  
    $('.deadmau5').click(function() {
        group_id = $(this).attr('group_id');
        title = $(this).attr('title');
        if (confirm("Удалить "+title+"?")) {
            $.ajax({
                type: "POST",
                url: "DeleteGroup",
                data: {
                    group_id : group_id
                },
                success: function(data){                                                       
                    if(data == "1"){
                        $('.group_generat tr.group_id_'+group_id).hide();
                    }
                }
            });
        } 
    });
    //delete
  
    //update
  
    $('.save2').click(function() {
        group_id = $(this).attr('group_id');
        value = $('#id_input_'+group_id).attr('value');
        zxc = $('#group_year_'+group_id+' option:selected').val();
        zxc_text = $('#group_year_'+group_id+' option:selected').text();
        $(this).parent().siblings().children('.show_god').text(zxc_text);
    
        $.ajax({
            type: "POST",
            url: "UpdateGroup",
            data: {
                group_id : group_id, 
                value : value,
                zxc : zxc
            },
            success: function(data){                                                       
                if(data == "1"){
                    $('.group_name_inp').hide();
                    $('.otmena2').hide();
                    $('.save2').hide();
                    $('.group_name').show();
                    $('.ediat_group').show();
                    $('.deadmau5').show();
                    $('#span_id_'+group_id).html(value);
                    $('.change_god').hide();
                    $('.show_god').show();
                }
            }
        });
  
    });
    //update
  
    $('.ediat_group').click(function() {
        $('.change_god').hide();
        $('.show_god').show();
        $(this).parent().siblings().children('.show_god').hide();
        $(this).parent().siblings().children('.change_god').show();
        $('.ediat_group').show();
        $('.deadmau5').show();
    
        id = $(this).attr('id_input');
        $('#span_id_'+id).hide();
        $('.group_name_inp').hide();
        $('.group_name').show();
        $(this).parent().siblings().children('.group_name').hide();
        $('.otmena2').hide();
        $('.save2').hide();
    
        $(this).siblings('.deadmau5').hide();
        id_input = $(this).attr('id_input');
        $(this).hide();
        $('#id_input_'+id_input).show();
        $('#id_input_save_'+id_input).show();
        $('#id_input_otm_'+id_input).show();
  
    });
    $('.otmena2').click(function() {
        $('.change_god').hide();
        $('.show_god').show();
        id_input = $(this).attr('id_input');
        $(this).siblings('.deadmau5').show();
        $('#id_input_'+id_input).hide();
        $('#id_input_save_'+id_input).hide();
        $('#id_input_otm_'+id_input).hide();
        $('.group_name').show();
        $('.ediat_group').show();
  
    });
  
  
    $('.close').click(function(){
        $('.all_bg').hide();
        $('.centrator').hide();
    });
    $('.all_bg').click(function(){
        $('.all_bg').hide();
        $('.centrator').hide();
    });




});
