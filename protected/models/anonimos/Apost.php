<?php

/**
 * This is the model class for table "apost".
 *
 * The followings are the available columns in table 'apost':
 * @property string $idpost
 * @property string $user_nom
 * @property string $idimagen
 * @property string $titulo
 * @property string $contenido
 * @property string $contrasenia
 * @property string $etiquetas
 * @property integer $idcategoria
 * @property string $tipo
 * @property integer $nun_visitas
 * @property integer $fecha
 */
class Apost extends CActiveRecord
{
    public $imagen;
    public $ccaptcha;
    public $tieneImagen = false;
    
    private $_oldTags;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Apost the static model class
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
		return 'apost';
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
			array('etiquetas,titulo, contenido, etiquetas, idcategoria', 'required'),
			array('nun_visitas, idcategoria, fecha', 'numerical', 'integerOnly'=>true),
			array('user_nom', 'length', 'max'=>50),
                        array('tipo','length','max'=>10),
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
			'contenido' => 'Contenido',
			'contrasenia' => 'Contraseña',
                        'idcategoria'=>'Seleccione una Categoria',
			'etiquetas' => 'Etiquetas',
			'tipo' => 'Tipo',
			'nun_visitas' => 'Nun Visitas',
			'fecha' => 'Fecha',
                        'imagen'=>'Imagen'
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

		$criteria->compare('idpost',$this->idpost,true);
		$criteria->compare('user_nom',$this->user_nom,true);
		$criteria->compare('idimagen',$this->idimagen,true);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('contenido',$this->contenido,true);
		$criteria->compare('contrasenia',$this->contrasenia,true);
		$criteria->compare('etiquetas',$this->etiquetas,true);
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('nun_visitas',$this->nun_visitas);
		$criteria->compare('fecha',$this->fecha);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        /**
	 * @return array a list of links that point to the post list filtered by every tag of this post
	 */
	public function getTagLinks()
	{
		$links=array();
		foreach(Aetiquetas::string2array($this->etiquetas) as $tag)
			$links[]=CHtml::link(CHtml::encode($tag), array('/anonimo/post/etiquetas', 'tag'=>$tag));
		return $links;
	}

	/**
	 * Normalizes the user-entered tags.
	 */
	public function normalizeTags($attribute,$params)
	{
		$this->etiquetas=Aetiquetas::array2string(array_unique(Aetiquetas::string2array($this->etiquetas)));
	}
        
        /**
	 * This is invoked when a record is populated with data from a find() call.
	 */
	protected function afterFind()
	{
		parent::afterFind();
		$this->_oldTags=$this->etiquetas;
                if(is_numeric($this->idimagen))
                {
                    $this->tieneImagen = true;
                }        
	}
        
        /**
	 * This is invoked after the record is saved.
	 */
	protected function afterSave()
	{
		parent::afterSave();
		Aetiquetas::model()->updateFrequency($this->_oldTags, $this->etiquetas);
	}

	/**
	 * This is invoked after the record is deleted.
	 */
	protected function afterDelete()
	{
		parent::afterDelete();
		//Comment::model()->deleteAll('post_id='.$this->id);
		Aetiquetas::model()->updateFrequency($this->etiquetas, '');
	}
        
        public function findImagenes($max=10)
        {
            $imagenes = $this->findAll('idimagen is not null order by fecha desc limit '.$max);
            $rs = array();
            foreach($imagenes as $imagen)
            {
                $img = Aimagen::model()->findByPk($imagen->idimagen);
                $archivoImg = Yii::app()->request->baseUrl.'/'.$img->thumb_directorio.'/'.$img->nom_thumb;
                $htmlImg=  CHtml::image($archivoImg, $img->nombre_original,array('class'=>'avatar_img'));
                $rs[] = new ImagenPost($imagen->idpost, $imagen->titulo, $htmlImg);
            }
            
            return $rs;
        }
        
        public function ultimosPost($max=10)
        {
            $up = $this->findAll('fecha is not null order by fecha desc limit '.$max);
            $rs = array();
            foreach($up as $post)
            {
                $rs[]= new ImagenPost($post->idpost,$post->titulo,'');//CHtml::link(Util::minizarString($post->titulo), array());
            }
            return $rs;
        }
        
        public function getImagen($ancho,$alto)
        {
            if($this->tieneImagen)
            {
                $img = Aimagen::model()->findByPk($this->idimagen);
                if($img != null)
                {
                    $urlImg = Yii::app()->request->baseUrl.'/'.$img->directorio.'/'.$img->nombre;
                    if($img->ancho > 950)
                        $ancho = 835;
                    return CHtml::image($urlImg,$img->nombre_original,array('width'=>$ancho));
                }
            }
            return null;
        }
        
        public function postsPorCategoria($idCategoria)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idcategoria',$idCategoria,true);	

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array('defaultOrder'=>'fecha DESC'),
		));
	}
        
        public function postEncontrados($palabra)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('titulo',$palabra,true);                

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array('defaultOrder'=>'fecha DESC'),
		));
	}
        
        public static function todosPost()
        {
            $criteria=new CDbCriteria;
            $total = Apost::model()->count();
 
            $pages = new CPagination($total);
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
 
            $posts = Apost::model()->findAll($criteria);
            
            return array(
              'pages'=>$pages,
              'posts'=>$posts 
            );
        }
        
        public function imgenesDeposts()
        {
            $criteria=new CDbCriteria;

		$criteria->compare('idimagen','<>(NULL)',true);	

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array('defaultOrder'=>'fecha DESC'),
		));
        }
}



















