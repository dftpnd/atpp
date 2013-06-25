<?php

class ProjectController extends Controller {

  public function actionIndex() {
    $title = 'Проекты';
    MyHelper::render($this, 'index', array(), $title);
  }

  public function actionDampfturbine() {
    $this->pageTitle = 'Мой проект';

    $this->renderPartial('MyProjrct');
  }

}