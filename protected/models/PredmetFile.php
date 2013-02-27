<?php

/**
 * This is the model class for table "{{predmet_file}}".
 *
 * The followings are the available columns in table '{{predmet_file}}':
 * @property integer $id
 * @property string $name
 * @property string $path
 * @property integer $plus
 * @property integer $minus
 * @property integer $profile_id
 * @property integer $semestr_id
 * @property string $created
 * @property integer $file_id
 * @property integer $predmet_id
 */
class PredmetFile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PredmetFile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{predmet_file}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, profile_id', 'required'),
			array('id, plus, minus, profile_id, semestr_id, file_id, predmet_id, created', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('id, name, plus, minus, profile_id, semestr_id, created, file_id, predmet_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'path' => 'Path',
			'plus' => 'Plus',
			'minus' => 'Minus',
			'profile_id' => 'Profile',
			'semestr_id' => 'Semestr',
			'created' => 'Created',
			'file_id' => 'File',
			'predmet_id' => 'Predmet',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('plus',$this->plus);
		$criteria->compare('minus',$this->minus);
		$criteria->compare('profile_id',$this->profile_id);
		$criteria->compare('semestr_id',$this->semestr_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('file_id',$this->file_id);
		$criteria->compare('predmet_id',$this->predmet_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}