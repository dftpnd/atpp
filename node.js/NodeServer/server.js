// Подключаем модуль и ставим на прослушивание 8080-порта - 80й обычно занят под http-сервер
//process.stdout.write(chunk);
//JSON.parse()
var domen = 'atpp.mg.nt';

var io = require('socket.io').listen(8080); 
var http = require("http");
var url = require('url');
var request = require("request");


io.set('log level', 1);
io.on('connection', function(socket) {
  /**
     * Сохранение сообщения в базе и рассылка по чату
     */
  function SaveMessage(data){  
        
    //делаем запрос на сервер для сохранения данных
    request({
      uri: "http://"+domen+"/node/SaveMessage",
      method: "POST",
      form: ({
        'user_id': data.user_id,
        'chat_id': data.chat_id,
        'msg': data.message
      })
    }, function(error, response, body) {
            
      var result = JSON.parse(body);   
      if (result.status == 'success'){
        
        // Отсылаем сообщение себе
        socket.emit('addMessage', {
          'username': result.username, 
          'message': data.message, 
          'time': result.time,
          'from': 'self',
          'chat_id':result.chat_id
        });
                              
        //отправляем в чат 
        socket.broadcast.to(data.chat_id).emit('addMessage', {
          'username': result.username, 
          'message': data.message, 
          'time': result.time,
          'from': 'to_all',
          'chat_id':result.chat_id
        });

        socket.emit('changeStatusChat', result.status_change);                  
      } else {
        socket.emit('addMessage', {
          'username': 'Системная ошибка', 
          'message': result.message, 
          'time': result.time
        });
      }
    });

  }
  
    
  socket.on('createChatProceed', function (params) {
        
    request({
      uri: "http://"+domen+"/site/CreateChatProceed",
      method: "POST",
      form: ({
        'sistem_id': params.sistem_id,
        'user_id': params.user_id,
        'title': params.title
      })
    }, function(error, response, body) {
            
            
      var result = JSON.parse(body);  
            
      if (result.status == 'success'){
                
        socket.emit('forceJoinChat',  result.chat_id);
        socket.broadcast.to(consultant_chat).emit('forceJoinChat',  result.chat_id);
                
      } else {
        socket.emit('getError', {
          'error': 'asdasd'
        });
      }
    });
        
  });
  /*
     * тянем историю сообщений
     */
  socket.on('getChatHistory', function (params, callback) {
    request({
      uri: "http://"+domen+"/site/GetChatHistory",
      method: "POST",
      form: ({
        'sistem_id': params.sistem_id,
        'user_id': params.user_id,
        'chat_id': params.chat_id,
        'msg': params.message,
        'limit': params.limit,
        'offset': params.offset
      })
    }, function(error, response, body) {
     
      var result = JSON.parse(body); 
      callback(result);
    });
  });
    
    
    
  socket.on("clientSendMessage", function (msg) {
    SaveMessage(msg);
  });
    
  /**
     * подключается User
     */
  socket.on('newUserConnect', function (data) {
    
    if(data.sistem_id == RTI_NEW){
      //если подключился админ
      socket.join(consultant_chat);
      countOpenChats(false);
    }
    request({
      uri: "http://"+domen+"/site/GetAllChatId",
      method: "POST",
      form:{
        'data':data
      }
    }, function(error, response, body) {
            
            
      var result = JSON.parse(body);   
            
      for (var chat_id in result){
        socket.emit('forceJoinChat',  chat_id);
      }
            
            
    });
  });
    
  socket.on('joinChat', function (chat_id) {
    socket.join(chat_id);
    countOpenChats(true);
  })
    
  socket.on('newChat', function (chat_id) {
    socket.broadcast.to(consultant_chat).emit('forceJoinChat', chat_id);
       
  })
    
  socket.on('infoChat', function (chat_id) {
        
    request({
      uri: "http://"+domen+"/site/InfoChat",
      method: "POST",
      form:{
        'chat_id':chat_id
      }
    }, function(error, response, body) {
      
      var result = JSON.parse(body);   
      socket.emit('infoChat', result);
    });
        
        
        
  })
    
    
    
  socket.on('deleteChat', function (chat_id) {
        
    request({
      uri: "http://"+domen+"/site/DeleteChat",
      method: "POST",
      form:{
        'chat_id':chat_id
      }
    }, function(error, response, body) {
      var result = JSON.parse(body);   
            
            
      if(result.status == 'succses'){
                    
        socket.emit('deleteChat', chat_id);
                     
        socket.broadcast.to(chat_id).emit('deleteChat', chat_id);

        countOpenChats(true);
                    
      }else{                        
        socket.emit('getError');
      }
    }); 
        
  })
    
  socket.on('changeStatusChat', function (data) {
        
    request({
      uri: "http://"+domen+"/site/ChangeStatusChat",
      method: "POST",
      form:{
        'chat_id':data.chat_id,
        'status_id': data.status_id
      }
    }, function(error, response, body) {
      var result = JSON.parse(body);   
            
      if(result.status == 'succses'){
                    
        socket.emit('changeStatusChat', data);
                     
        socket.broadcast.to(data.chat_id).emit('changeStatusChat', data);
                
        countOpenChats(true);
                    
      }else
                        
        socket.emit('getError');
            
    }); 
        
  })
    
});

