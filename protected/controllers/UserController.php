<?php

class UserController extends Controller {

  public function actionEditProfile() {
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile(Yii::app()->request->baseUrl . '/css/fileuploader.css');


    $group = array();
    $user_id = Yii::app()->user->id;

    $model = Profile::model()->with('uploadedfiles')->findByAttributes(array('user_id' => Yii::app()->user->id));
    if (isset($_POST['Profile'])) {

      $model->attributes = $_POST['Profile'];
      if (isset($_POST['Profile']['group_id']))
        $model->group_id = $_POST['Profile']['group_id'];

      if ($model->save()) {
        Yii::app()->user->setFlash('seccsesOpearation', "Данные успешно сохранены");
      }
    }
    if (isset($model->group_id))
      $group = Group::model()->findByPk($model->group_id);


    $gi = '';
    $yc = '';
    if (isset($group->id_year_create))
      $yc = $group->id_year_create;
    if (isset($group->id))
      $gi = $group->id;
    $predmetprepod = false;
    if ($model->status == 3)
      $predmetprepod = PredmetPrepod::model()->findAllByAttributes(array('profile_id' => $model->id));


    $title = $model->name . ' ' . $model->surname;

    MyHelper::render($this, 'editprofile', array(
        'model' => $model,
        'predmetprepod' => $predmetprepod,
        'group' => $group,
        'yc' => $yc,
        'gi' => $gi
            ), $title);
  }

  public function actionStats($user_id) {
    $user = User::model()->findByPk($user_id);
    $profile = $user->prof;

    if ($user_id == Yii::app()->user->id)
      $my_prof = TRUE;
    else
      $my_prof = FALSE;



    $group = Group::model()->findByPk($profile->group_id);
    $stats_srav = array();
    $psg_model = PredmetSemestrGroup::model()->with('predmet')->findAllByAttributes(array('group_id' => $profile->group_id));
    foreach ($psg_model as $box) {
      $stats_srav[$box->semestr_id][$box->id] = $box->predmet_id;
    }

    $rating = Rating::model()->findAll();
    $entry = array();
    if (isset($_POST['resultts'])) {
      if ($my_prof) {
        $count_predmets = 0;
        $summa = 0;
        foreach ($_POST['resultts'] as $key => $semestr) {
          foreach ($semestr as $predmet => $result) {
            $usp = UserSemestrPredmet::model()->findByAttributes(array('semestr_id' => $key, 'user_id' => $user_id, 'predmet_id' => $predmet));
            if (empty($usp)) {
              $usp = new UserSemestrPredmet;
              $usp->semestr_id = $key;
              $usp->user_id = $user_id;
              $usp->predmet_id = $predmet;
            }
            if (!empty($result)) {
              if (isset($stats_srav[$key]))
                if (in_array($predmet, $stats_srav[$key])) {
                  $usp->rating_id = $result;
                  $usp->save();
                  $entry[$usp->semestr_id][$usp->predmet_id] = $usp->rating_id;
                  $summa += (int) $result + 1;
                  $count_predmets++;
                }
            } else {
              if (!$usp->isNewRecord)
                $usp->delete();
            }
          }
        }
        $gss = GroupSemestrStatistic::model();
        $statistic = Statistic::model();
//среднее для юзера
        $profile->mean = substr($summa / $count_predmets, 0, 5);
        $profile->save();
//среднее для группы
        $psofiles = Profile::model()->findAllByAttributes(array('group_id' => $profile->group_id));
        $count_profiles = 0;
        $summa_group = 0;
        foreach ($psofiles as $profile) {
          if (!is_null($profile->mean)) {
            $count_profiles++;
            $summa_group += $profile->mean;
          }
        }
        $group->mean = substr($summa_group / $count_profiles, 0, 5);
        $group->save();
        echo CJSON::encode(array('status' => 'success'));
        exit();
      } else {
        echo CJSON::encode(array('status' => 'error'));
        exit();
      }
    } else {
      $usp_model = UserSemestrPredmet::model()->findAllByAttributes(array('user_id' => $user_id));
      foreach ($usp_model as $value) {
        $entry[$value->semestr_id][$value->predmet_id] = $value->rating_id;
      }
    }


    $title = "Зачетка";
    MyHelper::render($this, 'stats', array(
        'model' => $profile,
        'group' => $group,
        'psg_model' => $psg_model,
        'rating' => $rating,
        'entry' => $entry,
        'my_prof' => $my_prof
            ), $title);
  }

  public function actionViewStudent() {
    if (!isset($_POST['profile_id']) || !isset($_POST['group_id']))
      exit();
    $chartData = array();
    $entry = array();
    $sum = array();
    $polka = array();
    $profile = Profile::model()->findByPk($_POST['profile_id']);
    $group = Group::model()->findByPk($_POST['group_id']);
    $psg_model = PredmetSemestrGroup::model()->with('predmet')->findAllByAttributes(array('group_id' => $_POST['group_id']));
    $usp_model = UserSemestrPredmet::model()->findAllByAttributes(array('user_id' => $profile->user_id), array('order' => 'semestr_id'));

    $gyc = GroupYearCreate::model()->findByPk($group->id_year_create);
    $lop = $gyc->start_year;


    foreach ($usp_model as $value) {
      $yu = $value->rating_id + 1;
      $entry[$value->semestr_id][] = $yu;
      isset($sum[$value->semestr_id]) ? $sum[$value->semestr_id] += $yu : $sum[$value->semestr_id] = $yu;
    }
    foreach ($entry as $key => $value) {
      $polka[$key] = count($value);
    }
    foreach ($sum as $key => $value) {
      $polka[$key] = substr($value / $polka[$key], 0, 5);
    }
    $co = '0';
    $j = $lop;
    for ($i = $group->id_semestr; $i <= $group->id_semestr + 9; $i++) {
      $mib = $j;
      if ($co == '0') {
        $co = '1';
        if ($i != $group->id_semestr) {
          $j++;
          $mib = $j;
        }
      } else {
        $co = '0';
        $mib = '';
      }
      if (isset($polka[$i])) {
        $vrem = $polka[$i];
        $chartData[] = array(
            'point' => $mib,
            'view-student' => $vrem
        );
      }
    }

    $graphs = array();
    $graphs[] = array(
        'id' => 'view-student',
        'name' => 'График успеваемости студента',
    );

    $options = array(
        'writeId' => 'chartdiv',
        'showAllGraph' => 'true'
    );



    $data = $this->renderPartial('/doors/_view_student', array('profile' => $profile), true);
    echo json_encode(array('div' => $data, 'chartData' => $chartData, 'graphs' => $graphs, 'options' => $options,));
  }

  public function actionCompareStudent() {
    if (!isset($_POST['students']) || !isset($_POST['group_id']))
      exit();
    $students = array();
    $chartData = array();


    $students = $_POST['students'];


    $group = Group::model()->findByPk($_POST['group_id']);
    $gyc = GroupYearCreate::model()->findByPk($group->id_year_create);
    $psg_model = PredmetSemestrGroup::model()->with('predmet')->findAllByAttributes(array('group_id' => $_POST['group_id']));
    $lop = $gyc->start_year;

    foreach ($students as $student) {
      $entry = array();
      $sum = array();
      $polka = array();
      $sum = array();

      $profile = Profile::model()->findByPk($student);
      $usp_model = UserSemestrPredmet::model()->findAllByAttributes(array('user_id' => $profile->user_id), array('order' => 'semestr_id'));


      foreach ($usp_model as $value) {
        $yu = $value->rating_id + 1;
        $entry[$value->semestr_id][] = $yu;
        isset($sum[$value->semestr_id]) ? $sum[$value->semestr_id] += $yu : $sum[$value->semestr_id] = $yu;
      }

      foreach ($entry as $key => $value) {
        $polka[$key] = count($value);
      }
      foreach ($sum as $key => $value) {
        $polka[$key] = substr($value / $polka[$key], 0, 5);
      }

      $co = '0';
      $j = $lop;
      for ($i = 0; $i <= 9; $i++) {
        $mib = $j;
        if ($co == '0') {
          $co = '1';
          if ($i != 0) {
            $j++;
            $mib = $j;
          }
        } else {
          $co = '0';
          $mib = '';
        }
        if (isset($polka[$i])) {
          $predmas[$i]['point'] = $mib;
          $predmas[$i]['студент' . $student] = $polka[$i];
        }
      }


      $graphs[] = array(
          'id' => 'студент' . $student,
          'name' => $profile->name . ' ' . $profile->surname,
      );
    }
    foreach ($predmas as $key => $value) {
      $chartData[] = $predmas[$key];
    }



    $graphs[] = array(
        'id' => 'view-student',
    );


    $options = array(
        'writeId' => 'chartdiv',
        'showAllGraph' => 'true'
    );

    $data = $this->renderPartial('/doors/_compare_student', array('profile' => $profile), true);
    echo json_encode(array('div' => $data, 'chartData' => $chartData, 'graphs' => $graphs, 'options' => $options,));
  }

  public function actionPredmetfile($id) {
    $profile = Profile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
    if (empty($profile)) {
      $this->render('site/reg_not_valid');
      exit('Вы нежданный гость тут, авторизоваться попробуй ты');
    }
    if ($profile->status != 2) {
      $this->render('site/reg_not_valid');
      exit('Вы нежданный гость тут, авторизоваться попробуй ты');
    }
    if (!isset($id)) {
      $this->render('site/reg_not_valid');
      exit('Вы нежданный гость тут, авторизоваться попробуй ты');
    }

    $predmet = Predmet::model()->findByPk($id);
    if (empty($predmet)) {
      $this->render('site/reg_not_valid');
      exit('Вы нежданный гость тут, авторизоваться попробуй ты');
    }
    $cs = Yii::app()->getClientScript();

    MyHelper::render($this, 'predmetfile', array(
        'predmet' => $predmet,
            ), $title);
  }

  public function actionMyGroup() {
    $dis_is = array();
    $offset_dis = '0';
    $ajax = FALSE;
    if (isset($_POST['dis_count'])) {
      $offset_dis = $_POST['dis_count'];
      $ajax = TRUE;
    }

    $type = ObjectRating::TYPE_SMALL_POST;
    $plus = ObjectRating::PLUS;
    $minus = ObjectRating::MINUS;

    $user_id = Yii::app()->user->id;
    $profile = Profile::model()->findByAttributes(array('user_id' => $user_id));
    $group = Group::model()->findByPk($profile->group_id);

//первый запрос (узнаем какие посты подтянуть)
    $criteria = new CDbCriteria();
//$criteria->order = 't.last_update DESC, child.last_update ASC';
    $criteria->order = 't.last_update DESC';
    $criteria->limit = 5;
    $criteria->offset = $offset_dis;
    $dis = Discussion::model()->findAllByAttributes(array('group_id' => $profile->group_id, 'parent_id' => NULL), $criteria);
    foreach ($dis as $value) {
      $dis_is[] = $value->id;
    }




//второй запрос тянем посты с коментами
    $criteria = new CDbCriteria();
    $criteria->order = 't.last_update DESC, child.last_update ASC';
    $discussions = Discussion::model()->with('child')->
            findAllByAttributes(
            array('id' => $dis_is), $criteria
    );
    $profiles = Profile::model()->findAllByAttributes(array('group_id' => $profile->group_id));


    if ($ajax) {
      count($discussions);
      $data = $this->renderPartial('ajax_small_post', array(
          'discussions' => $discussions,
          'type' => $type,
          'plus' => $plus,
          'minus' => $minus,
          'profile' => $profile,
              ), true
      );
      echo json_encode(array('div' => $data, 'count' => count($discussions)));
    } else {

      MyHelper::render($this, 'my_group', array(
          'group' => $group,
          'profiles' => $profiles,
          'profile' => $profile,
          'discussions' => $discussions,
          'type' => $type,
          'plus' => $plus,
          'minus' => $minus
              ), $title);
    }
  }

  public function actionClassmateBlokked() {
    if (!isset($_POST['profile_id']))
      die('ыы');

    $user_id = Yii::app()->user->id;
    $profile = Profile::model()->findByAttributes(array('user_id' => $user_id));
    if ($profile->leader != 1) {
      echo CJSON::encode(array('status' => 'no_leader'));
      exit();
    }

    $profile_blokked = Profile::model()->findByPk($_POST['profile_id']);
    if ($profile_blokked->group_id != $profile->group_id) {
      echo CJSON::encode(array('status' => 'no_leader'));
      exit();
    }
  }

  public function actionUploadfilegroup() {
    $user_id = Yii::app()->user->id;
    $profile = Profile::model()->findByAttributes(array('user_id' => $user_id));
    $uf = DIRECTORY_SEPARATOR;
    $basePath = Yii::app()->basePath . "{$uf}..{$uf}uploads{$uf}$profile->group_id{$uf}";
    if (!file_exists($basePath))
      mkdir($basePath);

    $allowedExtensions = array("png", "jpg", "gif", "exe", "rar", "zip", "doc", "docx", "xlsx");
    $sizeLimit = 20 * 1024 * 1024;

    $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
    $result = $uploader->handleUpload($basePath);
    if (empty($result['error'])) {
      $file = array(
          'name' => $result['filename'],
          'orig_name' => $result['user_filename'],
          'size' => $result['size'],
          'ext' => $result['ext'],
      );

      $Uploadedfiles = new Uploadedfiles();
      $Uploadedfiles->attributes = $file;
      $Uploadedfiles->save();

      $result['file_id'] = $Uploadedfiles->id;
    }
    $gf_model = new GroupFile();
    $gf_model->file_id = $Uploadedfiles->id;
    $gf_model->group_id = $profile->group_id;
    $gf_model->profile_id = $profile->id;
    $gf_model->create_time = time();
    $gf_model->save();

    echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
  }

  public function actionDeleteFileGroup() {
    $user_id = Yii::app()->user->id;
    $profile = Profile::model()->findByAttributes(array('user_id' => $user_id));
    $uf = DIRECTORY_SEPARATOR;
    $basePath = Yii::app()->basePath . "{$uf}..{$uf}uploads{$uf}$profile->group_id{$uf}";
    if (file_exists($basePath)) {
      if (isset($_POST['id'])) {

        $model = Uploadedfiles::model()->findByPk($_POST['id']);
        if (!empty($model)) {
          if (file_exists($basePath . $model->name)) {
            unlink($basePath . $model->name);
          }
          $model->delete();
          echo CJSON::encode(array('status' => 'success'));
          exit();
        }
      }
      exit();
    }
  }

  public function actionDeleteSmallPost() {

    if (isset($_POST['sp_id']) && isset($_POST['type']) && isset($_POST['pin'])) {
      $user_id = Yii::app()->user->id;
      $profile = Profile::model()->findByAttributes(array('user_id' => $user_id));


      if ($_POST['type'] == '3' || $_POST['type'] == '6') {
        $small_posts = Discussion::model()->findByPk($_POST['sp_id']);
      } elseif ($_POST['type'] == '4') {
        $small_posts = Wall::model()->findByPk($_POST['sp_id']);
      }

      $pin_1 = md5($profile->id * $profile->id + $profile->id + $profile->id);
      $pin_2 = $_POST['pin'];

      if ($small_posts->profile_id == $profile->id || $pin_1 == $pin_2) {
        $small_posts->delete();
        echo CJSON::encode(array('status' => 'success'));
      } else {
        echo CJSON::encode(array('status' => 'falure'));
      }
    }
  }

  public function actionDeleteSPComment() {

    if (isset($_POST['id_sp_comment']) && isset($_POST['type']) && isset($_POST['pin'])) {
      $user_id = Yii::app()->user->id;
      $profile = Profile::model()->findByAttributes(array('user_id' => $user_id));

      if ($_POST['type'] == '3' || $_POST['type'] == '6') {
        $small_posts = Discussion::model()->findByPk($_POST['id_sp_comment']);
      } elseif ($_POST['type'] == '4') {
        $small_posts = Wall::model()->findByPk($_POST['id_sp_comment']);
      }
      $pin_1 = md5($profile->id * $profile->id + $profile->id + $profile->id);
      $pin_2 = $_POST['pin'];

      if ($small_posts->profile_id == $profile->id || $pin_2 == $pin_1) {
        $small_posts->delete();
        echo CJSON::encode(array('status' => 'success'));
      } else {
        echo CJSON::encode(array('status' => 'falure'));
      }
    }
  }

  public function actionNewSmallPost() {

//СТАНДАРТИЗИРОВАТЬ КНОПКУ!!!
    if (isset($_POST['content_small_post']) && isset($_POST['type']) && isset($_POST['belong_id'])) {
      if (!$_POST['content_small_post'] == '') {

        $type = $_POST['type'];
        $plus = ObjectRating::PLUS;
        $minus = ObjectRating::MINUS;

        $user_id = Yii::app()->user->id;
        $profile = Profile::model()->findByAttributes(array('user_id' => $user_id));


        if ($type == '3') {//смолл пост
          $discussion = new Discussion();
          $discussion->group_id = $profile->group_id;
        } else if ($type == '4') {//стена
          $discussion = new Wall();
          if ($_POST['belong_id'] != 0) {
            $discussion->belong_id = $_POST['belong_id'];
          } else {
            die();
          }
        } else if ($type == '6') {//FORUM
          $discussion = new Discussion();
          $discussion->group_id = 999999;
        } else {
          die('error');
        }

        $discussion->profile_id = $profile->id;
        $discussion->content = $_POST['content_small_post'];
        $discussion->date = date('Y-m-d g:i:s');
        $discussion->last_update = time();
        $discussion->save();

        $data = $this->renderPartial('/user/_small_post', array('discussion' => $discussion, 'minus' => $minus, 'plus' => $plus, 'type' => $type, 'profile' => $profile), true);


        echo json_encode(array('div' => $data, 'status' => 'success', 'id' => $profile->id));
      } else {
        echo CJSON::encode(array('status' => 'falure'));
        exit();
      }
    } else {
      echo CJSON::encode(array('status' => 'falure'));
      exit();
    }
  }

  public function actionNewSmallPostComment() {
    if (!isset($_POST['content'])) {
      echo CJSON::encode(array('status' => 'falure'));
      exit();
    }
    if (!isset($_POST['small_post_id'])) {
      echo CJSON::encode(array('status' => 'falure'));
      exit();
    }
    if (!isset($_POST['type'])) {
      echo CJSON::encode(array('status' => 'falure'));
      exit();
    }

    $user_id = Yii::app()->user->id;
    $profile = Profile::model()->findByAttributes(array('user_id' => $user_id));

    if ($_POST['type'] == '3') {
      $discussion = new Discussion();
      $discussion->parent_id = $_POST['small_post_id'];
      $discussion_parent = Discussion::model()->findByPk($_POST['small_post_id']);
      $discussion_parent->last_update = time();
      $discussion_parent->update();
      $discussion->group_id = $profile->group_id;
    } else if ($_POST['type'] == '4') {
      $discussion = new Wall();
      $discussion->parent_id = $_POST['small_post_id'];
      $discussion_parent = Wall::model()->findByPk($_POST['small_post_id']);
      $discussion_parent->last_update = time();
      $discussion_parent->update();
      $discussion->belong_id = $profile->id;
    } else if ($_POST['type'] == '6') {
      $discussion = new Discussion();
      $discussion->parent_id = $_POST['small_post_id'];
      $discussion_parent = Discussion::model()->findByPk($_POST['small_post_id']);
      $discussion_parent->last_update = time();
      $discussion_parent->update();
      $discussion->group_id = '9999999';
    }

    $discussion->profile_id = $profile->id;
    $discussion->content = $_POST['content'];
    $discussion->date = date('Y-m-d g:i:s');
    $discussion->last_update = time();
    $discussion->save();

    if ($_POST['type'] == '3') {
      $parentDiscussion = Discussion::model()->findByPk($_POST['small_post_id']);
    } else if ($_POST['type'] == '4') {
      $parentDiscussion = Wall::model()->findByPk($_POST['small_post_id']);
    } else if ($_POST['type'] == '6') {
      $parentDiscussion = Discussion::model()->findByPk($_POST['small_post_id']);
    }
    $parentDiscussion->last_update = time();
    $parentDiscussion->update();

    $sp_id = $_POST['small_post_id'];

    $data = $this->renderPartial('/user/_sp_comment', array('comment' => $discussion, 'profile' => $profile, 'type' => $_POST['type']), true);
    echo json_encode(array('div' => $data, 'status' => 'success', 'sp_id' => $sp_id));
  }

  public function actionFindGroup() {
    if (isset($_POST['year_create_id'])) {
      $year_create_id = $_POST['year_create_id'];
      $find_group = Group::model()->findAllByAttributes(array('id_year_create' => $year_create_id));
      if (empty($find_group)) {
        echo CJSON::encode(array('status' => 'falure'));
        exit();
      }
      echo CHtml::dropDownList('Profile[group_id]', '', CHtml::listData($find_group, 'id', 'name'), array('prompt' => 'Имя группы'));
    }
  }

  public function actionViewProfile() {
    $type = ObjectRating::TYPE_WALL;
    $plus = ObjectRating::PLUS;
    $minus = ObjectRating::MINUS;


    $dis_is = array();
    $ajax = FALSE;
    $offset_dis = '0';

    if (isset($_GET['id'])) {
      $model = Profile::model()->findByPk($_GET['id']);
      $athor = Profile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));


      if (is_null($model)) {
        $this->render('/site/reg_not_valid', array());
        exit();
      } else {
        $user_id = $model->user_id;
      }
    } else if (!Yii::app()->user->isGuest) {
      $user_id = Yii::app()->user->id;
      $model = Profile::model()->findByAttributes(array('user_id' => $user_id));
      $id = $model->id;
      $athor = $model;
    } else {
      $this->render('/site/reg_not_valid', array());
      exit();
    }
    $title = $model->name . ' ' . $model->surname;
    $user_author = User::model()->findByPk($user_id);

    if (empty($model)) {
      $this->render('/site/reg_not_valid', array());
      exit();
    }
    $hozyin = $model;
    if (isset($_POST['dis_count'])) {
      $offset_dis = $_POST['dis_count'];
      $ajax = TRUE;
    }

    $group = Group::model()->findByPk($model->group_id);
//первый запрос (узнаем какие посты подтянуть)
    $criteria = new CDbCriteria();
//$criteria->order = 't.last_update DESC, child.last_update ASC';
    $criteria->order = 't.last_update DESC';
    $criteria->limit = 5;
    $criteria->offset = $offset_dis;
    $dis = Wall::model()->findAllByAttributes(array('belong_id' => $model->id, 'parent_id' => NULL), $criteria);

    foreach ($dis as $value) {
      $dis_is[] = $value->id;
    }


//второй запрос тянем посты с коментами
    $criteria = new CDbCriteria();
    $criteria->order = 't.last_update DESC, child.last_update ASC';
    $discussions = Wall::model()->with('child')->
            findAllByAttributes(
            array('id' => $dis_is), $criteria
    );



    if ($model->status == 3) {// для перподов
      $user_author = User::model()->findByPk($user_id);
      $predmetprepod = PredmetPrepod::model()->findAllByAttributes(array('profile_id' => $model->id));

      MyHelper::render($this, 'viewprepod', array(
          'athor' => $athor,
          'profile' => $model,
          'discussions' => $discussions,
          'type' => $type,
          'plus' => $plus,
          'minus' => $minus,
          'user_author' => $user_author,
          'predmetprepod' => $predmetprepod
              ), $title);
      exit();
    }


    $chartData = array();
    $entry = array();
    $sum = array();
    $polka = array();
    $rating_3 = 0;
    $rating_4 = 0;
    $rating_5 = 0;
    $psg_model = PredmetSemestrGroup::model()->with('predmet')->findAllByAttributes(array('group_id' => $group->id));
    $usp_model = UserSemestrPredmet::model()->findAllByAttributes(array('user_id' => $model->user_id), array('order' => 'semestr_id'));
    $gyc = GroupYearCreate::model()->findByPk($group->id_year_create);
    $lop = $gyc->start_year;
    foreach ($usp_model as $value) {
      $yu = $value->rating_id + 1;
      $entry[$value->semestr_id][] = $yu;
      isset($sum[$value->semestr_id]) ? $sum[$value->semestr_id] += $yu : $sum[$value->semestr_id] = $yu;
      if ($value->rating_id == 2) {
        $rating_3++;
      }
      if ($value->rating_id == 3) {
        $rating_4++;
      }
      if ($value->rating_id == 4) {
        $rating_5++;
      }
    }
    foreach ($entry as $key => $value) {
      $polka[$key] = count($value);
    }
    foreach ($sum as $key => $value) {
      $polka[$key] = substr($value / $polka[$key], 0, 5);
    }
    $co = '0';
    $j = $lop;
    for ($i = $group->id_semestr; $i <= $group->id_semestr + 9; $i++) {
      $mib = $j;
      if ($co == '0') {
        $co = '1';
        if ($i != $group->id_semestr) {
          $j++;
          $mib = $j;
        }
      } else {
        $co = '0';
        $mib = '';
      }
      if (isset($polka[$i])) {
        $vrem = $polka[$i];
        $chartData[] = array(
            'point' => $mib,
            'view-student' => $vrem
        );
      }
    }

    $graphs = array();
    $graphs[] = array(
        'id' => 'view-student',
        'name' => 'График успеваемости студента',
    );
    $options = array(
        'writeId' => 'chartdiv',
        'showAllGraph' => 'true'
    );



    if ($ajax) {
      count($discussions);
      $data = $this->renderPartial('ajax_small_post', array(
          'discussions' => $discussions,
          'type' => $type,
          'plus' => $plus,
          'minus' => $minus,
          'profile' => $model,
          'hozyin' => $hozyin
              ), true
      );
      echo json_encode(array('div' => $data, 'count' => count($discussions)));
    } else {
      MyHelper::render($this, 'viewprofile', array(
          'athor' => $athor,
          'user_author' => $user_author,
          'group' => $group,
          'profile' => $model,
          'discussions' => $discussions,
          'type' => $type,
          'plus' => $plus,
          'minus' => $minus,
          'group' => $group,
          'chartData' => $chartData,
          'graphs' => $graphs,
          'options' => $options,
          'rating_5' => $rating_5,
          'rating_4' => $rating_4,
          'rating_3' => $rating_3,
              ), $title);
    }
  }

  public function actionSchedule() {
    $premets = array();
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile(Yii::app()->request->baseUrl . '/css/jquery-ui-1.9.2.custom.min.css');
    $data = '';
    $user_id = Yii::app()->user->id;
    $profile = Profile::model()->findByAttributes(array('user_id' => $user_id));

    $group = Group::model()->findByPk($profile->group_id);
    $kurs = PredmetSemestrGroup::NowKurs($group->inseption->start_year);
    $semestr = PredmetSemestrGroup::NowSemestr();
    $semestr_id = (($kurs - 1) * 2) + $semestr;

    $psg_model = PredmetSemestrGroup::model()->with('predmet')->findAllByAttributes(array('group_id' => $group->id, 'semestr_id' => $semestr_id));
    $predmets_id = '';
    foreach ($psg_model as $predmets) {
      if ($predmets_id == '')
        $predmets_id = $predmets->predmet_id;
      else
        $predmets_id .= ', ' . $predmets->predmet_id;

      $predmets_condition[] = $predmets->predmet_id;
    }
    $type_pair = TypePair::model()->findAll();

    $order_pair = OrderPair::model()->findAll();
    if (isset($predmets_condition)) {
      $premets = Predmet::model()->findAllByAttributes(array('id' => $predmets_condition));
      $data = CHtml::listData($premets, 'id', 'name');
    }
    $data2 = CHtml::listData($order_pair, 'id', 'name');
    $week_razd = WeekRazd::model()->findAll();
    $data3 = CHtml::listData($week_razd, 'id', 'name');
    $time_pair = TimePair::model()->findAll();
    $cont_group_id = $profile->group_id;

    $wekdays = Weekday::model()->
            with('schedule')->
            findAll(
            array(
                'order' => 't.id ASC,`order` ASC',
                'condition' => '(
                    schedule.group_id = "' . $profile->group_id . '"
                    and schedule.semestr_id = "' . $semestr_id . '"
                     )
                        or
                    (schedule.id is null)'
            )
    );


    /* определение четности недели */
    $masc_week = WeekMask::model()->findByPk($semestr);

    $week_num = '';
    if (isset($masc_week->week_num))
      $week_num = $masc_week->week_num;

    $now_week = date('W') - $week_num;
    if ($now_week == 0) {
      $we = '3';
    } else {
      if ($now_week % 2) {
        $we = '2';
      } else {
        $we = '3';
      }
    }
    /* определение четности недели */

    $title = 'Рассписание';
    MyHelper::render($this, 'schedule', array(
        'semestr_id' => $semestr_id,
        'profile' => $profile,
        'kurs' => $kurs,
        'semestr' => $semestr,
        'psg_model' => $psg_model,
        'type_pair' => $type_pair,
        'time_pair' => $time_pair,
        'premets' => $premets,
        'wekdays' => $wekdays,
        'data' => $data,
        'data2' => $data2,
        'data3' => $data3,
        'we' => $we
            ), $title);
  }

  public function actionEditSchedule() {
    $user_id = Yii::app()->user->id;
    $profile = Profile::model()->findByAttributes(array('user_id' => $user_id));
    $premets = array();
    if ($profile->leader == 1) {
      $group = Group::model()->findByPk($profile->group_id);
      $kurs = PredmetSemestrGroup::NowKurs($group->inseption->start_year);
      $semestr = PredmetSemestrGroup::NowSemestr();
      $semestr_id = (($kurs - 1) * 2) + $semestr;

      $psg_model = PredmetSemestrGroup::model()->with('predmet')->findAllByAttributes(array('group_id' => $group->id, 'semestr_id' => $semestr_id));

      $predmets_id = '';
      foreach ($psg_model as $predmets) {
        if ($predmets_id == '')
          $predmets_id = $predmets->predmet_id;
        else
          $predmets_id .= ', ' . $predmets->predmet_id;

        $predmets_condition[] = $predmets->predmet_id;
      }
      $type_pair = TypePair::model()->findAll();
      $order_pair = OrderPair::model()->findAll();
      $data = '';
      if (isset($predmets_condition)) {
        $premets = Predmet::model()->findAllByAttributes(array('id' => $predmets_condition));
        $data = CHtml::listData($premets, 'id', 'name');
      }
      $data2 = CHtml::listData($order_pair, 'id', 'name');
      $week_razd = WeekRazd::model()->findAll();
      $data3 = CHtml::listData($week_razd, 'id', 'name');
      $time_pair = TimePair::model()->findAll();

      $cont_group_id = $profile->group_id;


      if (isset($_POST)) {

        $i = 0;
        if (isset($_POST['order'])) {
          $day_id = $_POST['day_id'];
          if (isset($_POST['week_razd'])) {
            foreach ($_POST['order'] as $key => $pa) {
              $pair[$key][$pa]['room'] = $_POST['room'][$key];
              $pair[$key][$pa]['time_pair'] = $_POST['type_pair'][$key];
              $pair[$key][$pa]['type_pair'] = $_POST['time_pair'][$key];


              $sheduls = Schedule::model()->findByPk($key);
              $sheduls->week_razd = $_POST['week_razd'][$key];
              $sheduls->group_id = $cont_group_id;
              $sheduls->semestr_id = $semestr_id;
              $sheduls->weekday_id = $day_id;
              $sheduls->order = $pa;
              $sheduls->time_pair_id = $_POST['time_pair'][$key];
              $sheduls->type_pair_id = $_POST['type_pair'][$key];

              $sheduls->room = $pair[$key][$pa]['room'];
              if (isset($_POST['predmet'][$key])) {
                $pair[$key][$pa]['predmet'] = $_POST['predmet'][$key];
                $float_predemt = $_POST['predmet'][$key];

                $sheduls->predmet_id = $float_predemt;
                $sheduls->predmet_1_id = 0;
                $sheduls->predmet_2_id = 0;
              } else if (isset($_POST['predmet_1'][$key])) {
                $pair[$key][$pa]['predmet_1'] = $_POST['predmet_1'][$key];
                $float_predemt = $_POST['predmet_1'][$key];

                $sheduls->predmet_id = 0;
                $sheduls->predmet_1_id = $float_predemt;
                $sheduls->predmet_2_id = 0;
              } else if (isset($_POST['predmet_2'][$key])) {
                $pair[$key][$pa]['predmet_2'] = $_POST['predmet_2'][$key];
                $float_predemt = $_POST['predmet_2'][$key];

                $sheduls->predmet_id = 0;
                $sheduls->predmet_1_id = 0;
                $sheduls->predmet_2_id = $float_predemt;
              }
              if ($_POST['week_razd'][$key] == 1) {
//перенести его в обычный предмет
                $sheduls->predmet_id = $float_predemt;
                $sheduls->predmet_1_id = 0;
                $sheduls->predmet_2_id = 0;
              } else if ($_POST['week_razd'][$key] == 2) {
//перенести его в предмет *
                $sheduls->predmet_1_id = $float_predemt;
                $sheduls->predmet_2_id = 0;
                $sheduls->predmet_id = 0;
              } else if ($_POST['week_razd'][$key] == 3) {
//перенести его в предмет **
                $sheduls->predmet_2_id = $float_predemt;
                $sheduls->predmet_id = 0;
                $sheduls->predmet_1_id = 0;
              }

              $sheduls->save(false);

              $i++;
            }
          } else {
            echo CJSON::encode(array('status' => 'failure'));
          }
          Yii::app()->user->setFlash('commentSubmitted', 'Изменения сохранены');
        }
      }

      $wekdays = array();
      $wds = Weekday::model()->findAll();
      foreach ($wds as $wd) {
        $wekdays[$wd->id][$wd->tab] = Schedule::model()->findAllByAttributes(array('group_id' => $profile->group_id, 'semestr_id' => $semestr_id, 'weekday_id' => $wd->id));
      }

      $title = 'Редактирование рассписания';
      MyHelper::render($this, 'editschedule', array(
          'semestr_id' => $semestr_id,
          'kurs' => $kurs,
          'semestr' => $semestr,
          'psg_model' => $psg_model,
          'type_pair' => $type_pair,
          'time_pair' => $time_pair,
          'premets' => $premets,
          'wekdays' => $wekdays,
          'data' => $data,
          'data2' => $data2,
          'data3' => $data3,
              ), $title);
    }
  }

  public function actionNewScheduleDay() {
    if (isset($_POST['weekday_id'])) {
      $user_id = Yii::app()->user->id;
      $profile = Profile::model()->findByAttributes(array('user_id' => $user_id));
      $group = Group::model()->findByPk($profile->group_id);
      $kurs = PredmetSemestrGroup::NowKurs($group->inseption->start_year);
      $semestr = PredmetSemestrGroup::NowSemestr();
      $semestr_id = (($kurs - 1) * 2) + $semestr;
      $psg_model = PredmetSemestrGroup::model()->with('predmet')->findAllByAttributes(array('group_id' => $group->id, 'semestr_id' => $semestr_id));
      $predmets_id = '';
      foreach ($psg_model as $predmets) {
        if ($predmets_id == '')
          $predmets_id = $predmets->predmet_id;
        else
          $predmets_id .= ', ' . $predmets->predmet_id;

        $predmets_condition[] = $predmets->predmet_id;
      }
      $order_pair = OrderPair::model()->findAll();
      $premets = array();
      if (isset($predmets_condition))
        $premets = Predmet::model()->findAllByAttributes(array('id' => $predmets_condition));




      $schedule = new Schedule;
      $schedule->group_id = $profile->group_id;
      $schedule->semestr_id = $semestr_id;
      $schedule->weekday_id = $_POST['weekday_id'];
      $schedule->predmet_id = 0;
      $schedule->time_pair_id = 0;
      $schedule->type_pair_id = 0;
      $schedule->order = 0;
      $schedule->week_razd = 1;
      $schedule->save();


      $type_pair = TypePair::model()->findAll();
      $order_pair = OrderPair::model()->findAll();
      $time_pair = TimePair::model()->findAll();
      $week_razd = WeekRazd::model()->findAll();
      $data = CHtml::listData($premets, 'id', 'name');
      $data2 = CHtml::listData($order_pair, 'id', 'name');
      $data3 = CHtml::listData($week_razd, 'id', 'name');




      $wekdays = Weekday::model()->
              with('schedule')->
              findAll(
              '   (
                    schedule.group_id = "' . $profile->group_id . '"
                    and schedule.semestr_id = "' . $semestr_id . '"
                     )
                        or
                    (schedule.id is null)'
      );


      $data_html = $this->renderPartial('_tr_schedule', array(
          'semestr_id' => $semestr_id,
          'kurs' => $kurs,
          'semestr' => $semestr,
          'type_pair' => $type_pair,
          'time_pair' => $time_pair,
          'wekdays' => $wekdays,
          'data' => $data,
          'data2' => $data2,
          'data3' => $data3,
          'wekday_id' => $_POST['weekday_id'],
          'schedule' => $schedule,
              ), true
      );
      echo json_encode(array('div' => $data_html));
    }
  }

  public function actionDeleteScheduleDay() {
    if (isset($_POST['schedule_id'])) {
      Schedule::model()->deleteByPk($_POST['schedule_id']);
      echo CJSON::encode(array('status' => 'success'));
    }
  }

  public function actionPrepods() {
    $title = 'Преподователи';
    $prepods = array();

    $criteria = new CDbCriteria();
    $criteria->order = 't.surname ASC';

    $prepods = Profile::model()->with('uploadedfiles')->findAllByAttributes(array('status' => '3'), $criteria);


    MyHelper::render($this, '/reestr/prepods', array('models' => $prepods), $title);
  }

  public function actionStudents() {
    $title = 'Реестр студентов';
    $students = array();

    $criteria = new CDbCriteria();
    $criteria->order = 'prof.surname ASC';
    $criteria->condition = 'prof.status = 2';
    $students = User::model()->with('prof')->findAll($criteria);

    MyHelper::render($this, '/user/students', array(
        'models' => $students
            ), $title);
  }

  public function actionUploadAvatar() {
    $uf = DIRECTORY_SEPARATOR;
    $basePath = Yii::app()->basePath . "{$uf}..{$uf}uploads{$uf}avatar{$uf}";

    $allowedExtensions = array("png", "jpg", "gif", "jpeg");
    $sizeLimit = 2 * 1024 * 1024;
    $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
    $result = $uploader->handleUpload($basePath);

    if (empty($result['error'])) {
      $file = array(
          'name' => $result['filename'],
          'orig_name' => $result['user_filename'],
          'size' => $result['size'],
          'ext' => $result['ext'],
      );
      $Uploadedfiles = new Uploadedfiles();
      $Uploadedfiles->attributes = $file;
      $Uploadedfiles->save();

      $result['file_id'] = $Uploadedfiles->id;

      $profile = Profile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
      if (!is_null($profile->file_id)) {
        $file_name = $profile->uploadedfiles->name;
        if (file_exists(Yii::app()->basePath . "{$uf}..{$uf}uploads{$uf}avatar{$uf}" . $file_name)) {
          unlink(Yii::app()->basePath . "{$uf}..{$uf}uploads{$uf}avatar{$uf}" . $file_name);
        }
        if (file_exists(Yii::app()->basePath . "{$uf}..{$uf}uploads{$uf}avatar{$uf}mini_" . $file_name)) {
          unlink(Yii::app()->basePath . "{$uf}..{$uf}uploads{$uf}avatar{$uf}mini_" . $file_name);
        }
        if (file_exists(Yii::app()->basePath . "{$uf}..{$uf}uploads{$uf}avatar{$uf}avatar_" . $file_name)) {
          unlink(Yii::app()->basePath . "{$uf}..{$uf}uploads{$uf}avatar{$uf}avatar_" . $file_name);
        }
      }
      $profile->file_id = $Uploadedfiles->id;
      $profile->save(false);


      $img = Yii::app()->ih
              ->load($basePath . $Uploadedfiles->name);
      $result['file_url'] = Yii::app()->createAbsoluteUrl('uploads/avatar/' . $Uploadedfiles->name);

      if ($img->width > 150) {
        $img->resize(150, 250)
                ->save($basePath . 'avatar_' . $Uploadedfiles->name);
        $result['file_url'] = Yii::app()->
                createAbsoluteUrl('uploads/avatar/avatar_' . $Uploadedfiles->name);
      } else {
        $source = $basePath . $Uploadedfiles->name;
        $dest = $basePath . 'avatar_' . $Uploadedfiles->name;
        copy($source, $dest);
      }
      $img->resize(45, 45)
              ->save($basePath . 'mini_' . $Uploadedfiles->name);
    }
    echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
  }

  /*
   * экшен для плюсовния или минусования постов или коментов
   */

  public function actionObjectRating() {
    if (!isset($_POST['type']) || !isset($_POST['object_id']) || !isset($_POST['value'])) {
      echo CJSON::encode(array('status' => 'failure'));
      exit();
    }

    $profile = Profile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
    if ($_POST['type'] == ObjectRating::TYPE_COM) {//коммент
      $model = Comment::model()->findByPk($_POST['object_id']);
    } else if ($_POST['type'] == ObjectRating::TYPE_SMALL_POST) {//дисскуссия
      $model = Discussion::model()->findByPk($_POST['object_id']);
    } else if ($_POST['type'] == ObjectRating::TYPE_POST) {//пост
      $model = Post::model()->findByPk($_POST['object_id']);
    } else if ($_POST['type'] == ObjectRating::TYPE_WALL) {//пост
      $model = Wall::model()->findByPk($_POST['object_id']);
    } else if ($_POST['type'] == ObjectRating::lIBRARY_FILES) {//пост
      $model = PredmetFile::model()->findByPk($_POST['object_id']);
    } else if ($_POST['type'] == ObjectRating::FORUM) {//пост
      $model = Discussion::model()->findByPk($_POST['object_id']);
    } else {
      exit();
    }
    $author = Profile::model()->findByPk($model->profile_id);
    if ($model->profile_id != $profile->id) {
      if (ObjectRating::check($_POST['type'], $_POST['object_id'])) {

        if (ObjectRating::addRating($_POST['type'], $_POST['object_id'], $_POST['value'])) {

          if ($_POST['value'] == ObjectRating::PLUS) {
            $model->rating += 1;
            $author->plus += 1;
          } else if ($_POST['value'] == ObjectRating::MINUS) {
            $model->rating -= 1;
            $author->minus += 1;
          }
          $author->save(false);
          $model->save();
          $this_rating = $model->rating;
          echo CJSON::encode(array('status' => 'success', 'this_rating' => $this_rating));
          exit();
        } else {
          echo CJSON::encode(array('status' => 'failure'));
          exit();
//сообщаем об ошибке
        }
      } else {
//говорим что он уже проголосовал
        echo CJSON::encode(array('status' => 'voted'));
        exit();
      }
    } else {
//если юзер голучует за себя
      echo CJSON::encode(array('status' => 'not_himself'));
      exit();
    }
  }

  public function actionPredmetview($id) {
    if (isset($id)) {
      $predmet = Predmet::model()->findByPk($id);
      $this->render('predmetview', array('predmet' => $predmet));
    }
  }

  public function actionDeleteActivity() {
    if (!isset($_POST['id']))
      exit();

    if (Activity::model()->deleteByPk($_POST['id'])) {
      echo json_encode(array('status' => 'success'));
    } else {
      echo json_encode(array('status' => 'failure'));
    }
  }

  public function actionSaveActivity() {
    if (!isset($_POST['id']))
      exit();

    if (Activity::model()->deleteByPk($_POST['id'])) {
      echo json_encode(array('status' => 'success'));
    } else {
      echo json_encode(array('status' => 'failure'));
    }
  }

  public function actionManageGroup() {

    $user = User::model()->findByPk(Yii::app()->user->id);
    $group_id = $user->prof->group_id;


    $prepods = Profile::model()->findAllByAttributes(array('status' => '3'));

    $criteria = new CDbCriteria();
    $criteria->order = 't.surname ASC';
    $students = Profile::model()->findAllByAttributes(array('group_id' => $group_id), $criteria);

    $group = Group::model()->findByPk($group_id);
    $psg_model = PredmetSemestrGroup::model()->with('predmet')->findAllByAttributes(array('group_id' => $group_id));




    $title = 'Управление группой';
    MyHelper::render($this, 'manage_group', array(
        'prepods' => $prepods,
        'students' => $students,
        'group' => $group,
        'psg_model' => $psg_model,
            ), $title);
  }

  public function actionDeleteStudent() {

    if (!isset($_POST['user_id'])) {
      echo json_encode(array('status' => 'failure', 'error' => '1'));
      exit();
    }


    $user = User::model()->findByPk(Yii::app()->user->id);

    $student = Profile::model()->findByPk($_POST['user_id']);

    if (is_null($student)) {
      echo json_encode(array('status' => 'failure', 'error' => '2'));
      exit();
    }

    if (!$user->prof->group_id === $student->group_id) {
      echo json_encode(array('status' => 'failure', 'error' => '3'));
      exit();
    }

    if (!$user->prof->id === $student->id) {
      echo json_encode(array('status' => 'failure', 'error' => '4'));
      exit();
    }

    if (!$student->delete()) {
      echo json_encode(array('status' => 'failure', 'error' => '5'));
      exit();
    }


    echo json_encode(array('status' => 'success'));
  }

  public function actionBanStudent() {
    if (!isset($_POST['user_id'])) {
      echo json_encode(array('status' => 'failure', 'error' => '1'));
      exit();
    }


    $user = User::model()->findByPk(Yii::app()->user->id);

    $student = Profile::model()->findByPk($_POST['user_id']);

    if (is_null($student)) {
      echo json_encode(array('status' => 'failure', 'error' => '2'));
      exit();
    }

    if (!$user->prof->group_id === $student->group_id) {
      echo json_encode(array('status' => 'failure', 'error' => '3'));
      exit();
    }

    if (!$user->prof->id === $student->id) {
      echo json_encode(array('status' => 'failure', 'error' => '4'));
      exit();
    }

    $st_user = User::model()->findByPk($student->user_id);
    $st_user->banned = 1;


    if (!$st_user->save(false)) {
      echo json_encode(array('status' => 'failure', 'error' => '5'));
      exit();
    }

    echo json_encode(array('status' => 'success'));
  }

  public function actionRazBanStudent() {
    if (!isset($_POST['user_id'])) {
      echo json_encode(array('status' => 'failure', 'error' => '1'));
      exit();
    }


    $user = User::model()->findByPk(Yii::app()->user->id);

    $student = Profile::model()->findByPk($_POST['user_id']);

    if (is_null($student)) {
      echo json_encode(array('status' => 'failure', 'error' => '2'));
      exit();
    }

    if (!$user->prof->group_id === $student->group_id) {
      echo json_encode(array('status' => 'failure', 'error' => '3'));
      exit();
    }

    if (!$user->prof->id === $student->id) {
      echo json_encode(array('status' => 'failure', 'error' => '4'));
      exit();
    }

    $st_user = User::model()->findByPk($student->user_id);
    $st_user->banned = NULL;


    if (!$st_user->save(false)) {
      echo json_encode(array('status' => 'failure', 'error' => '5'));
      exit();
    }

    echo json_encode(array('status' => 'success'));
  }

  //=================files=====================//
  public function actionFiles($id, $parent_id = 0) {
    $new = FALSE;
    $mu_path = FALSE;
    $user = User::model()->findByPk($id);

    if ($user->id == Yii::app()->user->id)
      $mu_path = TRUE;


    $breadcrambs = Folder::model()->breadcrambs($parent_id, $id);
    $html_breadcrambs = $this->renderPartial('_breadcrambs', array(
        'breadcrambs' => $breadcrambs,
        'user' => $user,
            ), true);

    $folders = Folder::getAvailableFolder($parent_id, $user->id);

    $title = 'Файлы';
    $private_status = PrivateStatus::model()->findAll();
    MyHelper::render($this, 'user_files', array(
        'user' => $user,
        'folders' => $folders,
        'html_breadcrambs' => $html_breadcrambs,
        'private_status' => $private_status,
        'new' => $new,
        'mu_path' => $mu_path
            ), $title);
  }

  public function actionChangeFolder() {
    $mu_path = FALSE;
    if (!isset($_POST['folder_id']) || !isset($_POST['parent_id'])) {
      echo json_encode(array('status' => 'faile', 'error' => 'Ошибка, неверный запрос'));
      Yii::app()->end();
    }

    $folder = Folder::getMyFolder($_POST['folder_id'], $_POST['parent_id']);

    if (empty($folder->id)) {
      $mu_path = TRUE;
      $new = TRUE;
    }else
      $new = FALSE;

    if ($folder->user_id == Yii::app()->user->id)
      $mu_path = TRUE;

    $private_status = PrivateStatus::model()->findAll();

    $html = $this->renderPartial('_folder', array(
        'folder' => $folder,
        'private_status' => $private_status,
        'new' => $new,
        'mu_path' => $mu_path
            ), true);

    echo json_encode(array('status' => 'success', 'html' => $html));
  }

  public function actionDeleteFolder() {
    if (!isset($_POST['folder_id'])) {
      echo json_encode(array('status' => 'faile', 'error' => 'неверный file_id'));
      Yii::app()->end();
    }
    echo json_encode(Folder::deleteFolder($_POST['folder_id']));
  }

  public function actionUpdateDirectory() {
    $html = '';
    $mu_path = FALSE;

    if (!isset($_POST['parent_id']) || !isset($_POST['author_id'])) {
      echo json_encode(array('status' => 'faile', 'error' => 'Ошибка, поробуйте перезагрузить страницу'));
      Yii::app()->end();
    }
    $folders = Folder::getAvailableFolder($_POST['parent_id'], $_POST['author_id']);

    $private_status = PrivateStatus::model()->findAll();


    foreach ($folders as $folder) {
      if ($folder->user_id == Yii::app()->user->id)
        $mu_path = TRUE;

      $html .= $this->renderPartial('_folder', array(
          'folder' => $folder,
          'new' => false,
          'private_status' => $private_status,
          'mu_path' => $mu_path
              ), true);
    }

    echo json_encode(array('status' => 'success', 'html' => $html));
  }

  public function actionSaveChangeFolder() {

    $folder = Folder::getMyFolder($_POST['folder_id']);
    $folder->attributes = $_POST['Folder'][$_POST['folder_id']];


    $folder->user_id = Yii::app()->user->id;
    $folder->created = time();


    if ($folder->save()) {
      echo json_encode(array('status' => 'success', 'parent_id' => $folder->parent_id, 'author_id' => $folder->user_id,));
    } else {
      echo json_encode(array('status' => 'fail', 'error' => 'Сохранение не удалось, имя папки файла не должно быть пустым'));
    }
  }

  public function actionOpenFolder() {
    $html = '';
    $mu_path = FALSE;

    if (!isset($_POST['folder_id'])) {
      echo json_encode(array('status' => 'fail', 'error' => 'Ошибка, поробуйте перезагрузить страницу'));
      Yii::app()->end();
    }


    $folder = Folder::model()->findByPk($_POST['folder_id']);

    if ($folder->user_id == Yii::app()->user->id)
      $mu_path = TRUE;


    if (empty($folder)) {
      echo json_encode(array('status' => 'fail', 'error' => 'Не существует такой дирректори'));
      Yii::app()->end();
    }

    if (!Folder::checkAccess($folder)) {
      echo json_encode(array('status' => 'fail', 'error' => 'У вас недостаточно прав, для просмтора этой дирректории'));
      Yii::app()->end();
    }

    $user = User::model()->findByPk($folder->user_id);
    $folders = Folder::getAvailableFolder($folder->id, $folder->user_id);

    $private_status = PrivateStatus::model()->findAll();
    foreach ($folders as $model) {
      $html .= $this->renderPartial('_folder', array(
          'folder' => $model,
          'new' => FALSE,
          'private_status' => $private_status,
          'mu_path' => $mu_path
              ), true);
    }

    $breadcrambs = Folder::model()->breadcrambs($folder->id, $folder->user_id);

    $html_breadcrambs = $this->renderPartial('_breadcrambs', array(
        'breadcrambs' => $breadcrambs,
        'user' => $user,
            ), true);

    echo json_encode(
            array(
                'status' => 'success',
                'html' => $html,
                'folder' => (array) $folder->attributes,
                'html_breadcrambs' => $html_breadcrambs
            )
    );
  }

  public function actionDownloadFile($user_id, $parent_id) {
    if ($user_id !== Yii::app()->user->id) {
      echo json_encode(array('status' => 'fail', 'error' => 'Ошибка доступа'));
      Yii::app()->end();
    }

    $user = User::model()->findByPk($user_id);
    $basePath = Folder::basePath($user->id);
    $allowedExtensions = Folder::allowedExtensions();
    $sizeLimit = 50 * 1024 * 1024;
    $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
    $result = $uploader->handleUpload($basePath);


    if (!empty($result['error'])) {
      echo json_encode(array('status' => 'fail', 'error' => $result['error']));
      Yii::app()->end();
    }

    $file = array(
        'name' => $result['filename'],
        'orig_name' => $result['user_filename'],
        'size' => $result['size'],
        'ext' => $result['ext'],
    );

    $Uploadedfiles = new Uploadedfiles();
    $Uploadedfiles->attributes = $file;
    if (!$Uploadedfiles->save()) {
      echo json_encode(array('status' => 'fail', 'error' => 'Ошибка, сохранение не произошло 1'));
      Yii::app()->end();
    }

    $result['file_id'] = $Uploadedfiles->id;

    $folder = new Folder();
    $folder->user_id = $user->id;
    $folder->name = $result['user_filename'];
    $folder->parent_id = (int) $parent_id;
    $folder->created = time();
    $folder->uploads_id = $Uploadedfiles->id;
    $folder->private_status = PrivateStatus::ONLY_ME;
    $folder->type = Folder::FILE;
    if (!$folder->save()) {
      echo json_encode(array('status' => 'fail', 'error' => var_dump($folder->getErrors())));
      Yii::app()->end();
    }

    echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
  }

  public function actionDoorDownloadFile() {
    if (!isset($_POST['parent_id'])) {
      echo json_encode(array('status' => 'fail', 'error' => 'Ошибка, поробуйте перезагрузить страницу'));
      Yii::app()->end();
    }
    $parent_id = $_POST['parent_id'];


    if ((int) $parent_id == 0) {

      $folder = new Folder();

      $folder->name = MyHelper::getUsername(false, true, false, false);
    } else {
      $folder = Folder::model()->findByPk($parent_id);
      if (!Folder::checkAccess($folder)) {
        echo json_encode(array('status' => 'fail', 'error' => 'Ошибка, недостаточно прав'));
        Yii::app()->end();
      }
    }

    $user = User::model()->findByPk(Yii::app()->user->id);


    $html = $this->renderPartial('_door_download_file', array(
        'folder' => $folder,
        'user' => $user,
            ), true);

    echo json_encode(
            array(
                'status' => 'success',
                'html' => $html
            )
    );
  }

  public function actionDownloads($id) {
    $folder = Folder::model()->findByPk($id);

    if ($folder->private_status != PrivateStatus::EVERYONE) {
      if (!Folder::checkAccess($folder)) {
        die('недостаточно прав для скачивания');
      }
    }

    $file = Uploadedfiles::model()->findByPk($folder->uploads_id);

    if (!empty($file)) {
      $ds = DIRECTORY_SEPARATOR;
      $path = Yii::app()->basePath . $ds . '..' . $ds . 'uploads' . $ds . 'user_' . $folder->user_id . $ds . $file->name;
      if (file_exists($path)) {
        //папка с названием реестра
        //посыл хедеров браузеру
        header('Content-Disposition: attachment; filename="' . $folder->name . '"');
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Description: File Transfer");
        header('Content-Length: ' . $file->size);

        //скачивание
        echo file_get_contents($path);
        exit();
      }
    }
  }

//=================files=====================//
}

