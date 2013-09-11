<?php

class Controller extends SBaseController
{

    public $layout = 'column1';
    public $menu = array();
    public $breadcrumbs = array();

    public function init()
    {
        $cs = Yii::app()->clientScript;
        $cs->registerCoreScript('jquery');
        $cs->registerCoreScript('jquery.ui');
        $cs->registerScriptFile($this->createUrl('/js/jquery.md5.js'));
        $cs->registerScriptFile($this->createUrl('/js/jquery.scrollTo.min.js'));
        $cs->registerScriptFile($this->createUrl('/js/nprogress.js'));
        $cs->registerScriptFile($this->createUrl('/js/fileuploader.js'));
        $cs->registerScriptFile($this->createUrl('/js/amcharts.js'));
        $cs->registerScriptFile($this->createUrl('/js/amcharts_ui.js'));
        $cs->registerScriptFile($this->createUrl('/js/fixed_table_header.js'));
        $cs->registerScriptFile($this->createUrl('/js/door.js'));
        $cs->registerScriptFile($this->createUrl('/js/main.js'));
    }

}

// Yii::app()->clientScript->scriptMap['jquery.ba-bbq.js'] = false;
//$cs->registerScriptFile($this->createUrl('/js/jquery.ba-bbq.js'));