<?php

class ProjectController extends Controller {

  public function actionIndex() {
    $this->render('index');
  }

  public function actionMyProject() {
    $this->pageTitle = 'Мой проект';

    $this->renderPartial('MyProjrct');
  }

}