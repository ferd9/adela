<?php

/**
 * This is the model class for table "adl_visibilidad".
 *
 * The followings are the available columns in table 'adl_visibilidad':
 * @property string $idvisibilidad
 * @property string $tipo
 * @property string $ver
 * @property string $comentar
 * @property string $compartir
 * @property integer $fecha
 */
class Visibilidad extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Visibilidad the static model class
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
		return 'adl_visibilidad';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha', 'numerical', 'integerOnly'=>true),
			array('tipo', 'length', 'max'=>13),
			array('ver, comentar, compartir', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idvisibilidad, tipo, ver, comentar, compartir, fecha', 'safe', 'on'=>'search'),
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
			'idvisibilidad' => 'Idvisibilidad',
			'tipo' => 'Tipo',
			'ver' => 'Ver',
			'comentar' => 'Comentar',
			'compartir' => 'Compartir',
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

		$criteria->compare('idvisibilidad',$this->idvisibilidad,true);
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('ver',$this->ver,true);
		$criteria->compare('comentar',$this->comentar,true);
		$criteria->compare('compartir',$this->compartir,true);
		$criteria->compare('fecha',$this->fecha);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getIdVisibilidad($tipo='AMIGO')
        {
            $vs = $this->find("tipo='".$tipo."'");
            if($vs == null)
            {
                $this->fecha = time();               
                if($this->save())
                    return $this->idvisibilidad;
            }else
                return $vs->idvisibilidad;
        }
}