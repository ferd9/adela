<?php

/**
 * This is the model class for table "adl_foto".
 *
 * The followings are the available columns in table 'adl_foto':
 * @property string $idfoto
 * @property string $idperfil
 * @property string $idalbum
 * @property string $nombre
 * @property string $esfotoperfil
 * @property string $esfotoportada
 * @property string $descripcion
 * @property string $extension
 * @property integer $alto
 * @property integer $ancho
 * @property integer $peso
 * @property string $ruta
 * @property string $directorio
 * @property string $thumb_nom
 * @property integer $thumb_alto
 * @property integer $thumb_ancho
 * @property string $thumb_ruta
 * @property string $thumb_directorio
 * @property string $enpapelera
 * @property integer $idvisibilidad
 * @property integer $fecha
 */
class Foto extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Foto the static model class
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
		return 'adl_foto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idperfil, idalbum, nombre, descripcion', 'required'),
			array('alto, ancho, peso, thumb_alto, thumb_ancho, idvisibilidad, fecha', 'numerical', 'integerOnly'=>true),
			array('idperfil, idalbum', 'length', 'max'=>20),
			array('nombre, thumb_nom', 'length', 'max'=>100),
			array('esfotoperfil, esfotoportada, enpapelera', 'length', 'max'=>2),
			array('descripcion', 'length', 'max'=>500),
			array('extension', 'length', 'max'=>10),
			array('ruta, directorio, thumb_ruta, thumb_directorio', 'length', 'max'=>150),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idfoto, idperfil, idalbum, nombre, esfotoperfil, esfotoportada, descripcion, extension, alto, ancho, peso, ruta, directorio, thumb_nom, thumb_alto, thumb_ancho, thumb_ruta, thumb_directorio, enpapelera, idvisibilidad, fecha', 'safe', 'on'=>'search'),
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
			'idfoto' => 'Idfoto',
			'idperfil' => 'Idperfil',
			'idalbum' => 'Idalbum',
			'nombre' => 'Nombre',
			'esfotoperfil' => 'Esfotoperfil',
			'esfotoportada' => 'Esfotoportada',
			'descripcion' => 'Descripcion',
			'extension' => 'Extension',
			'alto' => 'Alto',
			'ancho' => 'Ancho',
			'peso' => 'Peso',
			'ruta' => 'Ruta',
			'directorio' => 'Directorio',
			'thumb_nom' => 'Thumb Nom',
			'thumb_alto' => 'Thumb Alto',
			'thumb_ancho' => 'Thumb Ancho',
			'thumb_ruta' => 'Thumb Ruta',
			'thumb_directorio' => 'Thumb Directorio',
			'enpapelera' => 'Enpapelera',
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

		$criteria->compare('idfoto',$this->idfoto,true);
		$criteria->compare('idperfil',$this->idperfil,true);
		$criteria->compare('idalbum',$this->idalbum,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('esfotoperfil',$this->esfotoperfil,true);
		$criteria->compare('esfotoportada',$this->esfotoportada,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('extension',$this->extension,true);
		$criteria->compare('alto',$this->alto);
		$criteria->compare('ancho',$this->ancho);
		$criteria->compare('peso',$this->peso);
		$criteria->compare('ruta',$this->ruta,true);
		$criteria->compare('directorio',$this->directorio,true);
		$criteria->compare('thumb_nom',$this->thumb_nom,true);
		$criteria->compare('thumb_alto',$this->thumb_alto);
		$criteria->compare('thumb_ancho',$this->thumb_ancho);
		$criteria->compare('thumb_ruta',$this->thumb_ruta,true);
		$criteria->compare('thumb_directorio',$this->thumb_directorio,true);
		$criteria->compare('enpapelera',$this->enpapelera,true);
		$criteria->compare('idvisibilidad',$this->idvisibilidad);
		$criteria->compare('fecha',$this->fecha);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}