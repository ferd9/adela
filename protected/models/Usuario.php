<?php

/**
 * This is the model class for table "adl_usuario".
 *
 * The followings are the available columns in table 'adl_usuario':
 * @property string $idusuario
 * @property string $email
 * @property string $nombre
 * @property string $apellidos
 * @property string $sexo
 * @property string $clave
 * @property string $salt
 * @property integer $f_nacimiento
 * @property string $banneado
 * @property string $confirmado
 * @property integer $fecha_reg
 *
 * The followings are the available model relations:
 * @property Perfil $perfil
 */
class Usuario extends CActiveRecord
{
    public $dia;
    public $mes;
    public $anio;
    public $verificarClave;
    public $verificarEmail;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Usuario the static model class
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
		return 'adl_usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, nombre, apellidos, sexo, clave, salt, fecha_reg, dia, mes, anio', 'required'),
                        array('email','email'),
                        array('email','unique'),
			array('f_nacimiento, fecha_reg', 'numerical', 'integerOnly'=>true),
			array('email, apellidos', 'length','max'=>250),
			array('nombre', 'length', 'max'=>150),
			array('sexo, banneado, confirmado', 'length', 'max'=>1),
			array('clave, salt', 'length', 'max'=>125),
                        array('nombre, apellidos', 'length', 'min'=>3),
                        array('clave', 'length', 'min'=>6),
                        array("verificarEmail", "compare", "compareAttribute" => "email"),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('email, nombre, apellidos, sexo, clave, salt, f_nacimiento, banneado, confirmado, fecha_reg', 'safe', 'on'=>'search'),
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
			'perfil' => array(self::HAS_ONE, 'Perfil', 'idperfil'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                        'idusuario'=>'idusuario',
			'email' => 'Email',
			'nombre' => 'Nombre',
			'apellidos' => 'Apellidos',
			'sexo' => '¿Eres?',
			'clave' => 'Contraseña',
			'salt' => 'Salt',
			'f_nacimiento' => 'F. Nacimiento',
			'banneado' => 'Banneado',
			'confirmado' => 'Confirmado',
			'fecha_reg' => 'Fecha Reg',
                        'dia'=>'Dia:',
                        'mes'=>'Mes',
                        'anio'=>'Año',
                        'verificarClave'=>'Repita la contraseña',
                        'verificarEmail'=>'Repetir Email'
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

		$criteria->compare('idusuario',$this->idusuario,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellidos',$this->apellidos,true);
		$criteria->compare('sexo',$this->sexo,true);
		$criteria->compare('clave',$this->clave,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('f_nacimiento',$this->f_nacimiento);
		$criteria->compare('banneado',$this->banneado,true);
		$criteria->compare('confirmado',$this->confirmado,true);
		$criteria->compare('fecha_reg',$this->fecha_reg);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        protected function beforeValidate() {
            
            $this->f_nacimiento = strtotime($this->anio.'-'.$this->mes.'-'.$this->dia);
            if(parent::beforeValidate())
                return true;
            else
                return false;
        }
        
        public function encryptPassword()
        {
            $this->salt = uniqid(strrev($this->email));
            $pscode = md5($this->salt.$this->clave);
            $this->clave = $pscode;
//            $this->verificarClave = $pscode;                       
        }
        
        public function verifyPassword($pass)
        {
            return md5($this->salt.$pass)==$this->clave;
        }
}