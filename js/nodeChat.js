/**
 * @TODO
 *  1. PHP docs                                                             +
 *  2. camalCase function names                                             +
 *  3. удалить неиспользуемые функции                                       +
 *  4. Где on('getError')?                                                  +
 *  5. Не использовать 'get' в названиях слушателей (on('GET'))             +
 *  6. Закрыть все @todo                                                    +
 *  7. написать иструкцию, как делать не надо))                             ?
 */

/**
 * стек чатов
 */
function ChatStackClass(node_server, user_id , sistem_id, signature, $selector) {       
  var that = this;
  this.socket = null;
  this.all_chats = [];
  this.user_id = user_id;
  this.sistem_id = sistem_id;
  this.signeture = signature;
  this.$selector = $selector;
  /**
 *функция инициализация подключения
 **/
  this.init = function(){
    if (navigator.userAgent.toLowerCase().indexOf('chrome') != -1) {
      that.socket = io.connect(node_server, {
        'transports': ['xhr-polling']
      });
    } else {
      that.socket = io.connect(node_server);
    }

    that.сreateExtraHtml();
        
    that.socket.on('connect', function (data) {
            
      that.socket.emit('newUserConnect', { 
        user_id: that.user_id,
        sistem_id: that.sistem_id,
        signature: that.signature
      });
        
        
    });
        
    that.socket.on('addMessage', function (msg) {
            
      //звук сообщений
      $("#beep-one")[0].play();
              
      that.all_chats[msg.chat_id].addMessage(msg, 'bot');
            
    });
        
        
    that.socket.on('forceJoinChat', function (chat_id) { 
      that.joinChat(chat_id);    
    });
        
    that.socket.on('countOpenChats', function (result) {
      $('.cons_chat_count').html('('+result.chat_count+')');
    });
        
    that.socket.on('deleteChat', function (chat_id) { 
            
      $('#chat_'+chat_id).remove();
        
    });
        
    that.socket.on('changeStatusChat', function (data) { 
        
      $('#chat_'+data.chat_id+' .ch_status_chat option[value='+data.status_id+']').attr("selected", "selected");
        
    });
        
    that.socket.on('infoChat', function (data) { 
            
      $('#chat_'+data.chat_id+' .ch_maine_title_chat').html(data.title);
            
      $('#chat_'+data.chat_id+' .ch_author').html(data.author);
            
      $('#chat_'+data.chat_id+' .ch_status_chat option[value='+data.status_id+']').attr("selected", "selected");
        
    });
        
    that.socket.on('getError', function (data) { 
            
      alert("Ошибка");
        
    });
    
    
  };
  /**
 * построение html-ки кнопки
 */
  this.сreateExtraHtml = function(){
                    
        
        
    if($('#ch_create_chat input').length > 0)
      $('#ch_create_chat input').remove();
        
    $('#ch_create_chat').html('<input type="button" value="Задать новый вопрос" />');
        
    $('#ch_create_chat input').on('click', function(){
      openDoor($( "#template_create_chat" ).render());
            
      $('#ch_create_chat_proceed').on('click', function(){
        $(this).addClass('loading');
                
                
        that.socket.emit('createChatProceed', {
          'sistem_id':that.sistem_id,
          'user_id':that.user_id,
          'signature':that.signature,
          'title': $('.title_chat').val()
        },that.renderChat);
                
        closeDoor();
            
      });
    });
  }
    
  /**
 * подключение к чату
 */
  this.joinChat = function(chat_id){
        
    that.socket.emit('joinChat', chat_id);
    that.renderChat(chat_id);
    
  }
    
  /**
 * отрисовка чата
 */
    
  this.renderChat = function(chat_id){
    if($selector.length != 0) {
      var mychat = new ChatClass( that.socket,  chat_id,  that.user_id, that.sistem_id,   that.signature);
      mychat.creteChatHtml(that.$selector);
      mychat.getChatHistory(5, 0);
        
      that.all_chats[chat_id] = mychat;
    }
  }
    
  /**
 * создание нового чата без перезагрузки
 */
    
  this.newChat = function(chat_id){
        
    that.socket.emit('newChat', chat_id);
    
  }

};

function ChatClass(socket, chat_id, user_id , sistem_id, signature) {    
    
  var that = this;
  this.socket = socket;
  this.chat_id = chat_id;
  this.user_id = user_id;
  this.sistem_id = sistem_id;
  this.signeture = signature;
  this.limit = 5;
  this.offset = 0;
  this.open = true;
    
  var chat_template_id = 'chat_template_id';
  var message_template_id = 'message_template_id';
  /**
 * создание чата в конкретном jQuery селекторе
 */
  this.creteChatHtml = function($selector){
    if($selector.length != 0 ) {
        
      if($('#chat_'+that.chat_id).length !== 0 )
        $('#chat_'+that.chat_id).remove();
        
        
      //рисуем html-ку для чата
      $selector.append($("#template-chat-chat").render({
        chat_id : that.chat_id
      }));
        
        
      //вешаем события
      $('#chat_'+ that.chat_id + ' .ch_send_message').on('click', function(){
        that.sendMessage();
      });
        
      $('#chat_'+ that.chat_id + ' .ch_hide_chat').on('click', function(){
        that.toogleChat();
      });
        
        
      $('#chat_'+ that.chat_id + ' .ch_status_chat').on('change', function(){
        that.changeStatusChat($(this).val());
      });
        
      $('#chat_'+ that.chat_id + ' .ch_delete_chat').on('click', function(){
        if (confirm("удалить?")) {
          that.deleteChat(that.chat_id);
        } 
      });
        
      that.infoChat();
    }
  }
  this.toogleChat = function(){
    var chat_html = $('#chat_'+ that.chat_id);
    chat_html.toggleClass('reduce')
  }
    
  this.changeStatusChat = function(status_id){
    that.socket.emit("changeStatusChat", {
      'status_id':status_id,
      'chat_id':that.chat_id
    });
    
  }
    
  this.infoChat = function(){
    that.socket.emit("infoChat", that.chat_id);
  }
    
  this.deleteChat = function(chat_id){
    that.socket.emit("deleteChat", chat_id);
  }
    
    
  /**
 * построение html-ки сообщения
 */
  this.createBodyMesage = function (msg_created, msg_username, msg_message, msg_sistem_id){
    var msg_template = []
    msg_template.push({
      msg_created: msg_created,
      msg_username: msg_username,
      msg_message: msg_message,
      msg_sistem_id:msg_sistem_id
    });
    return $("#template-chat-msg").render(msg_template);
    
  }
    
  /**
 * добавление сообщения в чат
 */
  this.addMessage = function(msg, side ){       
    
    if(side == 'top'){
            
    }else if(side == 'bot'){
      $('#chat_'+ that.chat_id+' .ch_log_chat').append(that.createBodyMesage(msg.time,  msg.username,  msg.message, msg.sistem_id));
      that.scrollDown();
    }
        
  }
    
  /*
 * заполнении истории чата
 */
  this.fillChatHistory = function(messages) {  
    for(key in messages) {
      that.addMessage(messages[key], 'bot');
    }
  };
  /*
 *прокрутка скрола вниз
 **/
  this.scrollDown = function() {  
        
    var el =  $('#chat_'+ that.chat_id+' .ch_log_chat');
    $('#chat_'+ that.chat_id+' .ch_text_block').scrollTop(el.height());
  };
    
  /**
 * получение истории чата
 */
  this.getChatHistory = function (limit, offset){      
    that.socket.emit('getChatHistory', { 
      user_id: that.user_id,
      sistem_id: that.sistem_id,
      chat_id: that.chat_id,
      signature: that.signature,                    
      limit: limit,
      offset: offset
    }, that.fillChatHistory);
  }
  /**
 * отправитьсообщение в чат
 */
  this.sendMessage = function (){
    var params = new Object();
        
    params.message = $('#chat_'+ that.chat_id+' .ch_msg_val').val();
    params.user_id = that.user_id;
    params.chat_id = that.chat_id;
    params.sistem_id = that.sistem_id;
        
    that.socket.emit("clientSendMessage", params);
        
    $('#chat_'+ that.chat_id+' .ch_msg_val').val(' ');
  }

};


        
        