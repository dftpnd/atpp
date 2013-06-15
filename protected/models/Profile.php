<?php

/**
 * This is the model class for table "{{profile}}".
 *
 * The followings are the available columns in table '{{profile}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $group
 * @property string $start
 * @property string $End
 * @property string $private
 * @property string $status
 * @property integer $file_id
 * @property string skype
 * @property string kontakt_email
 * @property string pthon
 * @property string contact_email
 * @property string kontact
 * @property string website
 */
class Profile extends CActiveRecord {

  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return Profile the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{profile}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
        array('user_id, name, surname', 'required'),
        array('user_id, file_id, leader', 'numerical', 'integerOnly' => true),
        array('name, surname, patronymic, pthon, skype, status, leader, pthon, website, kontakt_email, kontact', 'length', 'max' => 128),
        array('start, End, private', 'safe'),
        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array('id, minus, plus, skype, pthon, website, kontakt_email, kontact, user_id, name, surname, patronymic, start, End, private, status, file_id', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    return array(
        'uploadedfiles' => array(self::BELONGS_TO, 'Uploadedfiles', 'file_id'),
        'team' => array(self::BELONGS_TO, 'Group', 'group_id'),
        'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        'predmet_prepod' => array(self::HAS_MANY, 'PredmetPrepod', 'profile_id')
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
        'id' => 'ID',
        'user_id' => 'User',
        'name' => 'Имя',
        'surname' => 'Фамилия',
        'patronymic' => 'Отчество',
        //'group' => 'Group',
        'start' => 'Start',
        'End' => 'End',
        'private' => 'Что угодно',
        'status' => 'Статус',
        'file_id' => 'File',
        'leader' => 'leader',
        'pthon' => 'pthon',
        'kontakt_email' => 'kontakt_email',
        'website' => 'website',
        'kontact' => 'kontact',
        'skype' => 'skype',
    );
  }

  /**
   * Retrieves a list of models based on the current search/filter conditions.
   * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
   */
  public function search() {
    // Warning: Please modify the following code to remove attributes that
    // should not be searched.

    $criteria = new CDbCriteria;

    $criteria->compare('id', $this->id);
    $criteria->compare('user_id', $this->user_id);
    $criteria->compare('name', $this->name, true);
    $criteria->compare('surname', $this->surname, true);
    $criteria->compare('patronymic', $this->patronymic, true);
    //$criteria->compare('group', $this->group, true);
    $criteria->compare('start', $this->start, true);
    $criteria->compare('End', $this->End, true);
    $criteria->compare('private', $this->private, true);
    $criteria->compare('status', $this->status, true);
    $criteria->compare('file_id', $this->file_id);
    $criteria->compare('leader', $this->leader);

    return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
  }

  public function midleStats() {
    $student = $this->id;



    $entry = array();
    $sum = array();
    $polka = array();
    $rating_by_semestr = array();

    //узнаем оценки по предметам по семестрам
    $usp_model = UserSemestrPredmet::model()->findAllByAttributes(array('user_id' => $this->user_id), array('order' => 'semestr_id'));


    foreach ($usp_model as $value) {
      $rating = $value->rating_id + 1;
      $entry[$value->semestr_id][] = $rating;
      isset($rating_by_semestr[$value->semestr_id]) ? $rating_by_semestr[$value->semestr_id] += $rating : $rating_by_semestr[$value->semestr_id] = $rating;
    }


    //узнаем количество оценок полученных в семестре
    foreach ($entry as $key => $value) {
      $polka[$key] = count($value);
    }

    //узнаем среднюю оценку за семестр
    foreach ($rating_by_semestr as $key => $value) {
      $polka[$key] = substr($value / $polka[$key], 0, 5);
    }


    $co = '0';
    $j = 1;
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
        if (isset($predmas[$i][$group_name]))
          $predmas[$i][$group_name] = ($polka[$i] + $predmas[$i][$group_name]) / 2;
        else {
          $predmas[$i][$group_name] = $polka[$i];
        }
      }
    }



    $graphs[] = array(
        'id' => $group_name,
        'name' => $this->name . ' ' . $this->surname,
    );
  }

}