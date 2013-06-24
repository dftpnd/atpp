<?php

class ProjectController extends Controller {

  public function actionIndex() {
    $this->render('index');
  }

  public function actionDampfturbine() {
    $this->pageTitle = 'Мой проект';

    $this->renderPartial('MyProjrct');
  }

}