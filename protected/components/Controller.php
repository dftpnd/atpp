<?php

class Controller extends SBaseController
{

    public $layout = 'column1';
    public $menu = array();
    public $breadcrumbs = array();

    public function init()
    {
        $cs = Yii::app()->clientScript;
//        Yii::app()->clientScript->scriptMap['jquery.js'] = false;
//        Yii::app()->clientScript->scriptMap['jquery-ui.js'] = false;
        Yii::app()->clientScript->scriptMap['jquery.yiiactiveform.js'] = false;
        Yii::app()->clientScript->scriptMap['jquery.ba-bbq.js'] = false;


//        $cs->registerScriptFile($this->createUrl('/js/jquery-2.0.3.min.js'));
//        $cs->registerScriptFile($this->createUrl('/js/jquery-ui.min.js'));
        $cs->registerScriptFile($this->createUrl('/js/yiiactiveform.js'));
        $cs->registerScriptFile($this->createUrl('/js/jquery.md5.js'));
        $cs->registerScriptFile($this->createUrl('/js/jquery.scrollTo.min.js'));
        $cs->registerScriptFile($this->createUrl('/js/nprogress.js'));
        $cs->registerScriptFile($this->createUrl('/js/fileuploader.js'));
        $cs->registerScriptFile($this->createUrl('/js/amcharts.js'));
        $cs->registerScriptFile($this->createUrl('/js/amcharts_ui.js'));
        $cs->registerScriptFile($this->createUrl('/js/jq-scrool_old.js'));
        $cs->registerScriptFile($this->createUrl('/js/door.js'));
        $cs->registerScriptFile($this->createUrl('/js/maine.js'));
    }

}