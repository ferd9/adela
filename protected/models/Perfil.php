<?php

/**
 * This is the model class for table "adl_perfil".
 *
 * The followings are the available columns in table 'adl_perfil':
 * @property string $idperfil
 * @property string $login
 * @property string $foto
 * @property string $s_sentimental
 * @property string $frase
 * @property string $especialidad_social
 * @property string $intereses
 * @property string $descripcion
 * @property string $fono
 * @property string $movil
 * @property string $nextel
 *
 * The followings are the available model relations:
 * @property Usuario $idperfil0
 */
class Perfil extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Perfil the static model class
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
		return 'adl_perfil';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('login','unique'),
                        array('login','match','pattern'=>'/^[a-zA-Z0-9]\w+[a-zA-Z0-9]$/x'),
			array('login, frase', 'length', 'max'=>250),
                        array('foto', 'length', 'max'=>20),
                        array('s_sentimental','length','max'=>10),
			array('intereses', 'length', 'max'=>1),
			array('especialidad_social', 'length', 'max'=>300),
			array('fono, movil, nextel', 'length', 'max'=>15),
                        array('fono','match','pattern'=>'/^(\(\d{3}\)[-. ]?|\d{3}[-. ]?)?\d{3}[-. ]\d{4}$/x'),
                        array('nextel','match','pattern'=>'/^\d{3}\*\d{4}$/x'),
                        array('movil','length','min'=>9),
                        array('movil','match','pattern'=>'/^\d+$/'),
			array('descripcion', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idperfil, login, foto, s_sentimental, frase, especialidad_social, intereses, descripcion, fono, movil, nextel', 'safe', 'on'=>'search'),
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
			'idperfil0' => array(self::BELONGS_TO, 'Usuario', 'idperfil'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idperfil' => 'Idperfil',
			'login' => 'Login(nombre de usuario)',
			'foto' => 'Foto',
			's_sentimental' => 'Situación Sentimental',
			'frase' => 'Tu Frase favorita',
			'especialidad_social' => 'Tu Especialidad Social',
			'intereses' => '¿Te Interesan?',
			'descripcion' => 'Descripcion',
			'fono' => 'Telefono (ejem: (051)123-1235, 123-1235)',
			'movil' => 'Movil(Celular)',
			'nextel' => 'Nextel',
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

		$criteria->compare('idperfil',$this->idperfil,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('foto',$this->foto,true);
		$criteria->compare('s_sentimental',$this->s_sentimental,true);
		$criteria->compare('frase',$this->frase,true);
		$criteria->compare('especialidad_social',$this->especialidad_social,true);
		$criteria->compare('intereses',$this->intereses,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('fono',$this->fono,true);
		$criteria->compare('movil',$this->movil,true);
		$criteria->compare('nextel',$this->nextel,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getFoto()
        {
            $src = Yii::app()->request->baseUrl.'images/user/defaultmedium.gif';
            if(is_numeric($this->foto))
            {
                $foto = Foto::model()->findByPk($this->foto);
               if($foto != null)
               {
                   $src = Yii::app()->request->baseUrl.'/'.$foto->thumb_directorio.'/'.$foto->thumb_nom;
               }
            }
            
            return CHtml::image($src);
        }
}

















