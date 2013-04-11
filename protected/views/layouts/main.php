<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
  <head>
    <link href="/favicon.ico" rel="icon" type="image/x-icon" />
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="ru" />
    <meta name="document-state" content="Dynamic" />
    <meta name="keywords" content="АТПП, Кафедра КГЭУ Автоматизации Технологических Процессов и Производств" />
    <meta name="description" content="<?php echo CHtml::encode($this->pageTitle); ?>" />
    <meta name="generator" content="АТПП" />
    <meta name="robots" content="index,follow" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/widescreen.css" media="screen and (max-width: 1400px)" rel="stylesheet"/>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/door.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/maine.js"></script>
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-38492172-1']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
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
            <div class="kamen">
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
        <div id="" class="is-home wrapper">
          <div class="underwrapp">
            <div class="underwrapp_in_1"></div>
            <div class="underwrapp_in_2"></div>
          </div>
          <div class="in_head">
            <div class="header midelton">
              <div class="header-box-image"></div>
              <a href="<?php echo Yii::app()->urlManager->createUrl('site/index'); ?>" id="logo" title="Главная"></a>
              <div id="search">
                <label for="search_inp">Введите текст</label>
                <input id="search_inp" type="search" />
              </div>
              <div id="menu">
                <?php $this->renderPartial('application.views.layouts._menu', array('current_item' => 'about')) ?>
              </div> 
            </div>
          </div>



          <div class="contentus midelton">
            <?php if (!Yii::app()->user->isGuest): ?>
              <?php
              $this->renderPartial('application.views.layouts._menu_work', array('current_item' => 'about'));
              $random = rand(0, 8);
              $uf = '/';
              $PicterPath = "..{$uf}..{$uf}i{$uf}sky{$uf}apeak_" . $random . '.png';
              ?>
              <img class="up_head" title="Вверх!" src="<?php echo $PicterPath; ?>" />
              <div id="yaokor"></div>
            <?php endif; ?>

            <?php echo $content; ?>

            <div class="push"></div>
          </div>
          <div class="anchor"></div>
        </div>
        <div class="anchor"></div>


        <div class="footer ">
          <div class="midelton">
            <div class="footer_spa">
              <a class="git-hub" href="https://github.com/lkdnvc/atpp"></a>
              <div class="table_t foter_menu">
                <div class="tr_t">
                  <div class="td_t">
                    <a href="/site/photos" class="aspx_7">Кафедра в лицах</a>
                  </div>
                  <div class="td_t">
                    <a href="site/photos" class="aspx_4">История кафедры</a>
                  </div>
                </div>
                <div class="tr_t">
                  <div class="td_t">
                    <a href="site/photos" class="aspx_3">Что такое АТПП?</a>
                  </div>
                  <div class="td_t">
                    <a href="site/photos" class="aspx_8">Научная работа</a>
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
        $(function(){
          //          $('#menu li').each(function(index) {
          //            alert(index);
          //          });
        
          //реформер
          //        var reformalOptions = {
          //          project_id: 87248,
          //          project_host: "reformal.atpp.in",
          //          tab_orientation: "right",
          //          tab_indent: "50%",
          //          tab_bg_color: "#ba1419",
          //          tab_border_color: "#FFFFFF",
          //          tab_image_url: "http://tab.reformal.ru/T9GC0LfRi9Cy0Ysg0Lgg0L%252FRgNC10LTQu9C%252B0LbQtdC90LjRjw==/FFFFFF/a08a7c60392f68cb33f77d4f56cf8c6f/right/1/tab.png",
          //          tab_border_width: 2
          //        };
          //    
          //        (function() {
          //          var script = document.createElement('script');
          //          script.type = 'text/javascript'; script.async = true;
          //          script.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'media.reformal.ru/widgets/v3/reformal.js';
          //          document.getElementsByTagName('head')[0].appendChild(script);
          //        })();
        
          //поиск
          (function() {
            var _sw = document.createElement("script");
            _sw.type = "text/javascript";
            _sw.async = true;_sw.src = "https://suggest.io/js/v2/atpp.in/hjT6ECPy";var _sh = document.getElementsByTagName("head")[0]; _sh.appendChild(_sw);})(
        );
          //поиск
      </script>
<!--      <noscript><a href="http://reformal.ru"><img src="http://media.reformal.ru/reformal.png" /></a><a href="http://reformal.atpp.in">Отзывы и предложения для АТПП</a></noscript>-->
    </body>
</html>
