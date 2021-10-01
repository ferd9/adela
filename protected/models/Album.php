<?php

/**
 * This is the model class for table "adl_album".
 *
 * The followings are the available columns in table 'adl_album':
 * @property string $idalbum
 * @property string $idperfil
 * @property string $nombre
 * @property string $portada
 * @property string $url_portada
 * @property string $descripcion
 * @property integer $idvisibilidad
 * @property integer $fecha
 */
class Album extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Album the static model class
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
		return 'adl_album';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idperfil, nombre, descripcion, idvisibilidad, fecha', 'required'),
			array('idvisibilidad, fecha', 'numerical', 'integerOnly'=>true),
			array('idperfil, portada', 'length', 'max'=>20),
			array('nombre', 'length', 'max'=>125),
			array('url_portada', 'length', 'max'=>250),
			array('descripcion', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idalbum, idperfil, nombre, portada, url_portada, descripcion, idvisibilidad, fecha', 'safe', 'on'=>'search'),
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
			'idalbum' => 'Idalbum',
			'idperfil' => 'Idperfil',
			'nombre' => 'Nombre',
			'portada' => 'Portada',
			'url_portada' => 'Url Portada',
			'descripcion' => 'Descripcion',
			'idvisibilidad' => 'Idvisibilidad',
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

		$criteria->compare('idalbum',$this->idalbum,true);
		$criteria->compare('idperfil',$this->idperfil,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('portada',$this->portada,true);
		$criteria->compare('url_portada',$this->url_portada,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('idvisibilidad',$this->idvisibilidad);
		$criteria->compare('fecha',$this->fecha);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function albumImagnesPerfil($idPerfil){
            $this->nombre = 'Imagenes de perfil';
            $this->idperfil = $idPerfil;
            $this->descripcion='album creando el '.date('d-m-Y',time());
            $this->idvisibilidad = Visibilidad::model()->getIdVisibilidad();
            $this->fecha = time();
            if($this->save())
                return $this->idalbum;
            else{
                return -1;
            }
                
        }
}