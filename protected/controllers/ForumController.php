<?php

class ForumController extends Controller {

    public function actionIndex() {
        $type = ObjectRating::FORUM;
        $plus = ObjectRating::PLUS;
        $minus = ObjectRating::MINUS;
        $title = 'Форум';
        $athor = array();
        if (!Yii::app()->user->isGuest)
            $athor = Profile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));

        $criteria = new CDbCriteria();
        $criteria->order = 't.last_update DESC';

        $discussions = Discussion::model()->findAllByAttributes(array('group_id' => '999999'), $criteria);


        MyHelper::render($this, 'index', array(
            'athor' => $athor,
            'profile' => $athor,
            'type' => $type,
            'plus' => $plus,
            'minus' => $minus,
            'discussions' => $discussions
                ), $title);
    }

}