<?php

/**
 * This is the model class for table "acategoria".
 *
 * The followings are the available columns in table 'acategoria':
 * @property integer $idcategoria
 * @property string $nombre
 * @property integer $fecha
 */
class Acategoria extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Acategoria the static model class
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
		return 'acategoria';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre', 'required'),
			array('fecha', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>150),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idcategoria, nombre, fecha', 'safe', 'on'=>'search'),
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
			'idcategoria' => 'Idcategoria',
			'nombre' => 'Nombre',
			'fecha' => 'Fecha',
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

		$criteria->compare('idcategoria',$this->idcategoria);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('fecha',$this->fecha);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function getListCategoria()
        {
             $catego = Acategoria::model()->findAll();
             $catList = array();
             foreach ($catego as $cat)
             {
                $catList[$cat->idcategoria] = $cat->nombre;
             }
             
             return $catList;
        }
}