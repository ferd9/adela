<?php

/**
 * This is the model class for table "adl_estado".
 *
 * The followings are the available columns in table 'adl_estado':
 * @property string $idestado
 * @property string $idperfil
 * @property string $idfriend
 * @property string $idfoto
 * @property string $contenido
 * @property string $content_link
 * @property string $tipo
 * @property string $eliminado
 * @property integer $idvisibilidad
 * @property integer $fecha
 */
class Estado extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Estado the static model class
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
		return 'adl_estado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idperfil, contenido, fecha', 'required'),
			array('idvisibilidad, fecha', 'numerical', 'integerOnly'=>true),
			array('idperfil, idfriend, idfoto', 'length', 'max'=>20),
			array('tipo', 'length', 'max'=>11),
			array('eliminado', 'length', 'max'=>2),
			array('content_link', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idestado, idperfil, idfriend, idfoto, contenido, content_link, tipo, eliminado, idvisibilidad, fecha', 'safe', 'on'=>'search'),
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
			'idestado' => 'Idestado',
			'idperfil' => 'Idperfil',
			'idfriend' => 'Idfriend',
			'idfoto' => 'Idfoto',
			'contenido' => 'Contenido',
			'content_link' => 'Content Link',
			'tipo' => 'Tipo',
			'eliminado' => 'Eliminado',
			'idvisibilidad' => '¿Quiénes pueden ver?',
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

		$criteria->compare('idestado',$this->idestado,true);
		$criteria->compare('idperfil',$this->idperfil,true);
		$criteria->compare('idfriend',$this->idfriend,true);
		$criteria->compare('idfoto',$this->idfoto,true);
		$criteria->compare('contenido',$this->contenido,true);
		$criteria->compare('content_link',$this->content_link,true);
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('eliminado',$this->eliminado,true);
		$criteria->compare('idvisibilidad',$this->idvisibilidad);
		$criteria->compare('fecha',$this->fecha);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}