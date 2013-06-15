<style>
    #log {
        width: 590px;
        height: 290px;
        border: 1px solid rgb(192, 192, 192);
        padding: 5px;
        margin-bottom: 5px;
        font: 11pt 'Palatino Linotype';
        overflow: auto;
    }
    #input {
        width: 550px;
    }
    #send {
        width: 50px;
    }

    .in {
        color: rgb(0, 0, 0);
    }
    .out {
        color: rgb(0, 0, 0);
    }
    .time {
        color: rgb(144, 144, 144);
        font: 10pt 'Courier New';
    }
    .system {
        color: rgb(165, 42, 42);
    }
    .user {
        color: rgb(25, 25, 112);
    }
</style>
<script>
    // Создаем текст сообщений для событий
    strings = {
        'connected': '[sys][time]%time%[/time]: Вы успешно соединились к сервером как [user]%name%[/user].[/sys]',
        'userJoined': '[sys][time]%time%[/time]: Пользователь [user]%name%[/user] присоединился к чату.[/sys]',
        'messageSent': '[out][time]%time%[/time]: [user]%name%[/user]: %text%[/out]',
        'messageReceived': '[in][time]%time%[/time]: [user]%name%[/user]: %text%[/in]',
        'userSplit': '[sys][time]%time%[/time]: Пользователь [user]%name%[/user] покинул чат.[/sys]'
    };
    window.onload = function() {
        // Создаем соединение с сервером; websockets почему-то в Хроме не работают, используем xhr
        if (navigator.userAgent.toLowerCase().indexOf('chrome') != -1) {
            socket = io.connect('http://85.26.201.110:8080', {
                'transports': ['xhr-polling']
            });
        } else {
            socket = io.connect('http://85.26.201.110:8080');
        }
        socket.on('connect', function () {
            socket.on('message', function (msg) {
                // Добавляем в лог сообщение, заменив время, имя и текст на полученные
                document.querySelector('#log').innerHTML += strings[msg.event].replace(/\[([a-z]+)\]/g, '<span class="$1">').replace(/\[\/[a-z]+\]/g, '</span>').replace(/\%time\%/, msg.time).replace(/\%name\%/, msg.name).replace(/\%text\%/, unescape(msg.text).replace('<', '&lt;').replace('>', '&gt;')) + '<br>';
                // Прокручиваем лог в конец
                document.querySelector('#log').scrollTop = document.querySelector('#log').scrollHeight;
            });
            // При нажатии <Enter> или кнопки отправляем текст
            document.querySelector('#input').onkeypress = function(e) {
                if (e.which == '13') {
                    // Отправляем содержимое input'а, закодированное в escape-последовательность
                    socket.send(escape(document.querySelector('#input').value));
                    // Очищаем input
                    document.querySelector('#input').value = '';
                }
            };
            document.querySelector('#send').onclick = function() {
                socket.send(escape(document.querySelector('#input').value));
                document.querySelector('#input').value = '';
            };		
        });
    };
</script>
<div class="bb bl_gr mo" >
    <h1>consultant</h1>
    <script src="http://rti-client.new-techs.ru:8080/socket.io/socket.io.js"></script>
    <div id="log"></div>
    <input type="text" id="input" autofocus><input type="submit" id="send" value="Send">
</div>




















<div class='tabnav'>
    <ul class="tabnav-tabs">
        <l1 class="razdel1" >
            <a href="#" class='tabnav-tab selected'>Новые пользователи</a>
        </l1>
        <l1 class="razdel2" >
            <a href="#" class='tabnav-tab'>Все пользователи</a>
        </l1>
    </ul>
</div>
<div class='gem'>
    <div class="table_t">
        <div class="tr_t">
            <div class="td_t">id</div>
            <div class="td_t">username</div>
            <div class="td_t">ФИО</div>
            <div class="td_t">статус</div>
            <div class="td_t">&nbsp;</div>
            <div class="td_t">&nbsp;</div>
        </div>
        <?php foreach ($model as $user): ?>
            <div class="tr_t" id="user_<?php echo $user->id; ?>">
                <div class="td_t">
                    <?php echo $user->id; ?>
                </div>
                <div class="td_t">
                    <?php echo $user->username; ?>
                </div>
                <div class="td_t">
                    <?php if (isset($user->prof->name)): ?>
                        <?php echo $user->prof->name; ?>
                    <?php endif; ?>

                    <?php if (isset($user->prof->surname)): ?>
                        <?php echo $user->prof->surname; ?>
                    <?php endif; ?>

                    <?php if (isset($user->prof->patronymic)): ?>
                        <?php echo $user->prof->patronymic; ?>
                    <?php endif; ?>
                </div>
                <div class="td_t">
                    <?php if ($user->active == 1): ?>
                        <div class="user_activated">активирован</div>
                    <?php else: ?>
                        <div class="user_not_activated">не активирован</div>
                    <?php endif; ?>
                </div>
                <div class="td_t">

                </div>
                <div class="td_t">

                    <?php if ($user->active == 1): ?>
                        <?php echo CHtml::link('Забанить', Yii::app()->urlManager->createUrl('/userAdmin/admin/banuser', array('id' => $user->id))); ?>
                    <?php else: ?>
                        ЗАБАНЕН
                    <?php endif; ?>
                </div>
                <div class="td_t"><span class="delete_user" onclick="deleteUser('<?php echo $user->id; ?>','<?php if (isset($user->prof)) echo $user->prof->id;else echo '0' ?>')">Удалить</span></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
