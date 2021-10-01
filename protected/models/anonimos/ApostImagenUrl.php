<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ApostImagenUrl
 *
 * @author 3l@PR3ND1Z
 */
class ApostImagenUrl extends Apost{
    
    /**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
                $requeridCaptcha=array('ccaptcha','length','max'=>5);
                if(Yii::app()->user->isGuest)
                    $requeridCaptcha = array('ccaptcha', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements());
		return array(
			array('idcategoria, etiquetas,titulo, imagen, etiquetas', 'required'),
			array('nun_visitas, fecha', 'numerical', 'integerOnly'=>true),
			array('user_nom', 'length', 'max'=>50),
                        array('tipo','length','max'=>10),
                        array('imagen','url'),
                        array('idimagen', 'length', 'max'=>20),
			array('titulo', 'length', 'max'=>250),
                        $requeridCaptcha,                        
			array('contrasenia', 'length', 'max'=>180),
			array('etiquetas', 'length', 'max'=>320),
                        array('etiquetas', 'length', 'min'=>4),
                        //array('imagen','file','types'=>'jpg, jpeg, png, gif','maxSize'=>6291456),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idpost, user_nom, idimagen, titulo, contenido, contrasenia, etiquetas, tipo, nun_visitas, fecha', 'safe', 'on'=>'search'),
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
			'idpost' => 'Idpost',
			'user_nom' => 'Nombre',
			'idimagen' => 'Idimagen',
			'titulo' => 'Titulo',
			'contenido' => 'contenido',
			'contrasenia' => 'Contraseña',
			'etiquetas' => 'Etiquetas',
			'tipo' => 'Tipo',
			'nun_visitas' => 'Nun Visitas',
			'fecha' => 'Fecha',
                        'imagen'=>'URL del imagen',
                        'idcategoria'=>'Seleccione una categoira'
		);
	}
        
        public function beforeValidate() {
            
            $this->contenido = CHtml::image($this->imagen);
            if(parent::beforeValidate())
                return true;
            else
                return false;
        }
}

?>
