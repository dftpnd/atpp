<?php

class User extends CActiveRecord {

    public $password_repeat;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return '{{user}}';
    }

    public function rules() {
        return array(
            array('username, password, password_repeat', 'required'),
            array('username', 'unique'),
            array('username', 'email'),
            array('username, banned, laste_enter', 'length', 'max' => 128),
            array('profile', 'safe'),
            array('password_repeat', 'required', 'on' => 'register'),
            array('password password_repeat', 'compare', 'compareAttribute' => 'password'),
        );
    }

    public function relations() {
        return array(
            'posts' => array(self::HAS_MANY, 'Post', 'author_id'),
            'prof' => array(self::HAS_ONE, 'Profile', 'user_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'Id',
            'password_repeat' => 'Пароль',
            'password' => 'Пароль',
            'username' => 'Эл. почта',
            'profile' => 'Profile',
            'banned' => 'banned',
            'verifyCode' => '',
            'laste_enter' => 'laste_enter'
        );
    }

    public function validatePassword($password) {
        //return $this->hashPassword($password,$this->salt)===$this->password;
        return $password === $this->password;
    }

    public static function sendMail($view, $params) {
        $email = $params['recipient'];

        $mail_config = Yii::app()->params['smtp_params'];
        $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
        $mailer->SMTPAuth = TRUE;
        $mailer->IsSMTP();
        $mailer->Host = $mail_config['host']; //gmail.com
        $mailer->Username = $mail_config['user']; //user@gmail.com
        $mailer->Password = $mail_config['password']; //mypassword
        $mailer->From = $mail_config['user']; //user@gmail.com
        $mailer->AddAddress($email);
        $mailer->Subject = 'Подтверждение регистрации';
        $mailer->FromName = 'Сайт кафедры АТПП';
        $mailer->setPathViews('application.views.mailTemplates');
        $mailer->getView($view, $params);
        if (!$mailer->Send()) {
            Yii::log('Try to login with params: ' . print_r($mail_config, 1), 'warning');
            Yii::log($mailer->ErrorInfo, 'warning');
            return false;
        }
        Yii::log('Email send to ' . print_r($email, 1), 'warning');
        return true;
    }

}