<?php

/**
 * This is the model class for table "areportados".
 *
 * The followings are the available columns in table 'areportados':
 * @property integer $idreporte
 * @property string $motivo
 * @property string $idreportado
 * @property integer $fecha
 */
class Areportados extends CActiveRecord
{
    public $titulo;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Areportados the static model class
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
		return 'areportados';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('motivo, idreportado', 'required'),
			array('idreporte, fecha', 'numerical', 'integerOnly'=>true),
			array('idreportado', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idreporte, motivo, idreportado, fecha', 'safe', 'on'=>'search'),
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
			'idreporte' => 'Idreporte',
			'motivo' => 'Escriba el motivo',
			'idreportado' => 'Idreportado',
			'fecha' => 'Fecha',
                        'titulo'=>'titulo',
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

		$criteria->compare('idreporte',$this->idreporte);
		$criteria->compare('motivo',$this->motivo,true);
		$criteria->compare('idreportado',$this->idreportado,true);
		$criteria->compare('fecha',$this->fecha);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}