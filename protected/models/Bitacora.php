<?php

/**
 * This is the model class for table "adl_bitacora".
 *
 * The followings are the available columns in table 'adl_bitacora':
 * @property string $idbitacora
 * @property string $idusuario
 * @property string $navegador
 * @property string $version_navegador
 * @property string $so
 * @property string $ip
 * @property integer $fecha
 * @property integer $f_ultimo_ingreso
 */
class Bitacora extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Bitacora the static model class
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
		return 'adl_bitacora';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha, f_ultimo_ingreso', 'numerical', 'integerOnly'=>true),
			array('idusuario, ip', 'length', 'max'=>20),
			array('navegador, version_navegador, so', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idbitacora, idusuario, navegador, so, ip, fecha, f_ultimo_ingreso', 'safe', 'on'=>'search'),
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
			'idbitacora' => 'Idbitacora',
			'idusuario' => 'Idusuario',
			'navegador' => 'Navegador',
                        'version_navegador'=>'version',
			'so' => 'So',
			'ip' => 'Ip',
			'fecha' => 'Fecha',
			'f_ultimo_ingreso' => 'F Ultimo Ingreso',
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

		$criteria->compare('idbitacora',$this->idbitacora,true);
		$criteria->compare('idusuario',$this->idusuario,true);
		$criteria->compare('navegador',$this->navegador,true);
		$criteria->compare('so',$this->so,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('fecha',$this->fecha);
		$criteria->compare('f_ultimo_ingreso',$this->f_ultimo_ingreso);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        protected function beforeValidate() {
            $ua = new UserAgent();
            $this->so = $ua->os();
            $this->navegador = $ua->browser();
            $this->version_navegador = $ua->version();
            $this->ip = Yii::app()->request->getUserHostAddress();
            $this->fecha = time();
            if(parent::beforeValidate())
                return true;
            else
                return false;
        }
        
        public function setUserFecha($iduser,$lf)
        {
            $this->idusuario = $iduser;
            $this->f_ultimo_ingreso = $lf;
        }
}