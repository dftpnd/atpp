<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
  <head>
    <link href="/favicon.ico" rel="icon" type="image/x-icon" />
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="АТПП, Кафедра КГЭУ Автоматизации Технологических Процессов и Производств" />
    <meta name="description" content="<?php echo CHtml::encode($this->pageTitle); ?>" />
    <meta name="generator" content="АТПП" />
    <meta name="robots" content="index,follow" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/widescreen.css" media="screen and (max-width: 1400px)" rel="stylesheet"/>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/fileuploader.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/door.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/maine.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/amcharts.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/amcharts_ui.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jq-scrool_old.js"></script>
  </head>
  
  <?php if (Yii::app()->user->isGuest): ?>
    <?php $authorizad = 'notauthorizad' ?>
  <?php else: ?>
    <?php $authorizad = 'authorizad' ?>
  <?php endif; ?>
  <body class="home blog <?php echo $authorizad ?>">
    <h1 class="nonedisplay">АТПП, Кафедра КГЭУ Автоматизации Технологических Процессов и Производств</h1>
    <div class="oshib"></div>
    <div class="fixed_panel_for_close" title="Закрыть" onclick="ClearFileGroup()"></div>
    <div id="ajax_loader">
      <div id="foo"><!--spiner--></div>
    </div>
    <div class="door"  >
      <div class="door_box_1">
        <div class="my_cont">
          <div class="big_but close_door"></div>
          <div class="kamen" onclick="event.stopPropagation()">
            <div class="title_door">
              <h1></h1>
              <div class="zakrytb" onclick='closeDoor()'>Закрыть</div>
            </div>
            <div class="insert_here">
            </div>
          </div>
        </div>
      </div>
      <div class='door_box_2 close_door' ></div>
    </div>
    <div id="notice" class="notice_block_yellow">
      <div class="notice_hide" onclick="noticeHide()" ></div>
      <div class="notice_insert">
        <div class="notice_text">
          Ваш голос учтен
        </div>
      </div>
    </div>
    <div class="universe">
      <div class="is-home wrapper cacada_<?php echo rand(1, 4) ?>" >
        <div class="in_head">
          <div class="header midelton">
            <div class="header-box-image"></div>
            <a href="<?php echo Yii::app()->urlManager->createUrl('site/index'); ?>" id="logo" async="async" title="Главная"></a>
            <div id="search">
              <label for="search_inp">Введите текст</label>
              <input id="search_inp" type="search" />
            </div>
            <div id="menu">
              <?php $this->renderPartial('application.views.layouts._menu', array('current_item' => 'about')) ?>
            </div> 
          </div>

        </div>
        <div class="pila_top"></div>
        <div class="contentus midelton">
          <div class="content_loader">
            <div id="cl_ajax" class="cl_ajax"></div>
            <script>
              var opts = {
                lines: 23, // The number of lines to draw
                length: 23, // The length of each line
                width: 3, // The line thickness
                radius: 30, // The radius of the inner circle
                corners: 1, // Corner roundness (0..1)
                rotate: 0, // The rotation offset
                color: '#00BCF2', // #rgb or #rrggbb
                speed: 0.9, // Rounds per second
                trail: 60, // Afterglow percentage
                shadow: false, // Whether to render a shadow
                hwaccel: false, // Whether to use hardware acceleration
                className: 'spinner', // The CSS class to assign to the spinner
                zIndex: 2e9, // The z-index (defaults to 2000000000)
                top: 'auto', // Top position relative to parent in px
                left: 'auto' // Left position relative to parent in px
              };
              var target = document.getElementById('cl_ajax');
              var spinner = new Spinner(opts).spin(target);
            </script>
          </div>
          <?php if (!Yii::app()->user->isGuest): ?>
            <?php $this->renderPartial('application.views.layouts._menu_work', array('current_item' => 'about')); ?>
            <img class="up_head" title="Вверх!" src="<?php echo Yii::app()->request->baseUrl; ?>/i/sky/apeak_0.png" />
            <div id="yaokor"></div>
          <?php endif; ?>
          <div id="dynamic_content">
            <?php echo $content; ?>
          </div>
          <div class="push"></div>
        </div>
      </div>


      <div class="footer ">
        <div class="pila_bot"></div>
        <div class="midelton">
          <div class="footer_spa">
            <a class="git-hub" href="https://github.com/lkdnvc/atpp"></a>
            <div class="table_t foter_menu">
              <div class="tr_t">
                <div class="td_t">
                  <a href="/site/photos" class="aspx_7" async="async" >Кафедра в лицах</a>
                </div>
                <div class="td_t">
                  <a href="/site/contact" class="aspx_4" async="async" >Контакты</a>
                </div>
              </div>
              <div class="tr_t">
                <div class="td_t">
                  <a href="#" class="aspx_3" async="async" >Что такое АТПП?</a>
                </div>
                <div class="td_t">
                  <a href="#" class="aspx_8" async="async" >Научная работа</a>
                </div>
              </div>

            </div>
            <div class="year">
              2000 - <?php echo date('Y') ?>
            </div>
            <div class="caros">
              &copy; Кафедра КГЭУ &laquo;Автоматизации Технологических Процессов и Производств&raquo; 

            </div>

          </div>
        </div>
      </div>

    </div>
    <script type="text/javascript">
      //поиск
      (function() {
        var _sw = document.createElement("script");
        _sw.type = "text/javascript";
        _sw.async = true;_sw.src = "https://suggest.io/js/v2/atpp.in/hjT6ECPy";var _sh = document.getElementsByTagName("head")[0]; _sh.appendChild(_sw);
      })();
      //поиск
    </script>
  </body>
</html>
