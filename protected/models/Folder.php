<?php

/**
 * This is the model class for table "{{folder}}".
 *
 * The followings are the available columns in table '{{folder}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property integer $created
 * @property integer $private_status
 * @property integer $parent_id
 */
class Folder extends CActiveRecord {

  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return Folder the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{folder}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
        array('user_id, name, created', 'required'),
        array('user_id, created, private_status, parent_id', 'numerical', 'integerOnly' => true),
        array('name', 'length', 'max' => 255),
        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array('id, user_id, name, created, private_status, parent_id', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
        'id' => 'ID',
        'user_id' => 'User',
        'name' => 'Name',
        'created' => 'Created',
        'private_status' => 'Private Status',
        'parent_id' => 'Parent',
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
    $criteria->compare('created', $this->created);
    $criteria->compare('private_status', $this->private_status);
    $criteria->compare('parent_id', $this->parent_id);

    return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
  }

  public static function checkAccess($folder) {

    $user = User::model()->findByPk(Yii::app()->user->id);

    if ($user->id == $folder->user_id)
      return TRUE;

    switch ($folder->privat_status) {
      case PrivateStatus::ONLY_ME:
        return FALSE;
        break;
      case PrivateStatus::ME_AND_STUDENTS:
        if ($user->prof->status == 2)
          return TRUE;
        break;
      case PrivateStatus::ME_AND_TEACHERS:
        if ($user->prof->status == 3)
          return TRUE;
        break;
      case PrivateStatus::EVERYONE:
        return TRUE;
        break;
      default:
        break;
    }

    return FALSE;
  }

  public static function getMyFolder($folder_id) {

    if ($folder_id == 0)
      $folder = new Folder();
    else {
      $folder = self::model()->findByPk($folder_id);

      if (!$folder->user_id == Yii::app()->user->id) {
        echo jsone_encode(array('status' => 'faile', 'error' => 'У вас нет доступа'));
        exit();
      }

      if (empty($folder)) {
        echo jsone_encode(array('status' => 'faile', 'error' => 'Не существует такой папки'));
        exit();
      }
    }


    return $folder;
  }

}