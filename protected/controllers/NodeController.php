<?php

class NodeController extends Controller {

  public function actionChat() {
    $title = 'Сообщения';
    MyHelper::render($this, 'chat', array(), $title);
  }

}