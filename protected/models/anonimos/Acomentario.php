<?php

/**
 * This is the model class for table "acomentario".
 *
 * The followings are the available columns in table 'acomentario':
 * @property string $idcomentario
 * @property string $id_del_comentado
 * @property string $post_or_imagen
 * @property string $nombre
 * @property string $comentario
 * @property integer $fecha
 */
class Acomentario extends CActiveRecord
{
    public $ccaptcha;
    public $tituloPost;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Acomentario the static model class
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
		return 'acomentario';
	}

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
			array('id_del_comentado, post_or_imagen, comentario, fecha', 'required'),
			array('fecha', 'numerical', 'integerOnly'=>true),
			array('id_del_comentado', 'length', 'max'=>20),
			array('post_or_imagen', 'length', 'max'=>6),
                        $requeridCaptcha,
                        array('tituloPost','length','max'=>250),
			array('nombre', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idcomentario, id_del_comentado, post_or_imagen, nombre, comentario, fecha', 'safe', 'on'=>'search'),
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
                    //'apost'=>array(self::BELONGS_TO,)
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcomentario' => 'Idcomentario',
			'id_del_comentado' => 'Id Del Comentado',
			'post_or_imagen' => 'Post Or Imagen',
			'nombre' => 'Nombre',
			'comentario' => 'Comentario',
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

		$criteria->compare('idcomentario',$this->idcomentario,true);
		$criteria->compare('id_del_comentado',$this->id_del_comentado,true);
		$criteria->compare('post_or_imagen',$this->post_or_imagen,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('comentario',$this->comentario,true);
		$criteria->compare('fecha',$this->fecha);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function comentariosDePost($idPost)
        {
            $criteria=new CDbCriteria;
            $criteria->compare('id_del_comentado',$idPost,true);
            //$criteria->compare('post_or_imagen',  DefinidorTipos::$POST,true);
	
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
        }
        
        public function findComentariosNuevos($limite=10)
        {
            return $this->findAll(array(
			'order'=>'t.fecha DESC',
			'limit'=>$limite,
		));            
        }
}