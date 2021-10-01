<?php

/**
 * This is the model class for table "aimagen".
 *
 * The followings are the available columns in table 'aimagen':
 * @property string $idimagen
 * @property string $nombre_original
 * @property string $nombre
 * @property string $descripcion
 * @property string $extension
 * @property string $ruta
 * @property string $directorio
 * @property integer $ancho
 * @property integer $alto
 * @property string $nom_thumb
 * @property string $thumb_ruta
 * @property string $thumb_directorio
 * @property integer $thumb_ancho
 * @property integer $thumb_alto
 * @property integer $idCategoria
 * @property string $tipo
 * @property integer $num_visitas
 * @property string $enpost
 * @property integer $fecha
 */
class Aimagen extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Aimagen the static model class
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
		return 'aimagen';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
            return array(
                    array('ancho, alto, thumb_ancho, thumb_alto, idCategoria, num_visitas, fecha', 'numerical', 'integerOnly'=>true),
                    array('nombre_original, nombre, nom_thumb', 'length', 'max'=>225),
                    array('descripcion', 'length', 'max'=>600),
                    array('extension, tipo', 'length', 'max'=>15),
                    array('ruta, thumb_ruta', 'length', 'max'=>125),
                    array('directorio, thumb_directorio', 'length', 'max'=>50),
                    array('enpost', 'length', 'max'=>1),
                    // The following rule is used by search().
                    // Please remove those attributes that should not be searched.
                    array('idimagen, nombre_original, nombre, descripcion, extension, ruta, directorio, ancho, alto, nom_thumb, thumb_ruta, thumb_directorio, thumb_ancho, thumb_alto, idCategoria, tipo, num_visitas, enpost, fecha', 'safe', 'on'=>'search'),
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
			'idimagen' => 'Idimagen',
			'nombre' => 'Nombre',
			'descripcion' => 'Descripcion',
			'extension' => 'Extension',
			'ruta' => 'Ruta',
			'directorio' => 'Directorio',
			'ancho' => 'Ancho',
			'alto' => 'Alto',
			'nom_thumb' => 'Nom Thumb',
			'thumb_ruta' => 'Thumb Ruta',
			'thumb_directorio' => 'Thumb Directorio',
			'thumb_ancho' => 'Thumb Ancho',
			'thumb_alto' => 'Thumb Alto',
			'idCategoria' => 'Id Categoria',
			'tipo' => 'Tipo',
			'num_visitas' => 'Num Visitas',
			'enpost' => 'Enpost',
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

		$criteria->compare('idimagen',$this->idimagen,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('extension',$this->extension,true);
		$criteria->compare('ruta',$this->ruta,true);
		$criteria->compare('directorio',$this->directorio,true);
		$criteria->compare('ancho',$this->ancho);
		$criteria->compare('alto',$this->alto);
		$criteria->compare('nom_thumb',$this->nom_thumb,true);
		$criteria->compare('thumb_ruta',$this->thumb_ruta,true);
		$criteria->compare('thumb_directorio',$this->thumb_directorio,true);
		$criteria->compare('thumb_ancho',$this->thumb_ancho);
		$criteria->compare('thumb_alto',$this->thumb_alto);
		$criteria->compare('idCategoria',$this->idCategoria);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('num_visitas',$this->num_visitas);
		$criteria->compare('enpost',$this->enpost,true);
		$criteria->compare('fecha',$this->fecha);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}