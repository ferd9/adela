<?php $this->pageTitle=Yii::app()->name;?>   
<div class="box-imagen portlet span-13">
    <div class="portlet-header">
        <h4>BIENVENIDO</4>
    </div>
    <div class="portlet-content">  
        <div class="flash-notice">
            <p>Diviertete e invita a tus amigos.</p>
            <p>En la seecion de ANONIMOS puedes subir una imagen o publicar un video
                sin registrarte!!.</p>
            <p>Los usuarios registrados tiene beneficios totales para divertirse.</p>
        </div> 
        <?php 
        $cookie = Cookie::get('uacep');
            if(!$cookie or is_null($cookie))
                echo CHtml::link('Ir a seccion de anonimos', array('//anonimo','ctg'=>'General'), array('class'=>'btn btn-large','onclick'=>'$("#aviso").dialog("open"); return false;'));
            else
                echo CHtml::link('Ir a seccion de anonimos', array('//anonimo','ctg'=>'General'), array('class'=>'btn btn-large'));
            
            if(Yii::app()->user->isGuest)
                echo CHtml::link('Registrarse (RECOMENDADO)', array('//anonimo','ctg'=>'General'), array('class'=>'btn btn-large','style'=>'float:right;'));
        ?>
                
    </div>
   
</div>
<div class="f-registro portlet span-9">
  <?php if(Yii::app()->user->isGuest){?>  
    <?php $this->renderPartial('registro',array('model'=>$model));?>
  <?php }else if(!Yii::app()->user->isGuest){ ?> 
            
    <div class="portlet-content">
            <div class="flash-success">
                <p>Como usuario registrado tus privilegios son:</p>
                <ol>
                    <li>Puedes subir una imagen de hasta 5MB</li>
                    <li>Ya no debes ingresar el codigo Captcha</li>
                </ol>    
            </div>
    </div>    
           <?php }?> 
     <div class="portlet-content">  
        <div class="flash-notice">
            <p>Necesitamos tu apoyo.</p>
            <p>Puedes Apoyarnos compartiendo nuestros enlaces.</p>            
            <ul style="list-style: none; padding-bottom: 3px;">
                <li style="padding-bottom: 3px;"><?php echo CHtml::link('Hazte Fan en FaceBook', 'http://www.facebook.com', array('class'=>'btn btn-large','style'=>'color:white;','target'=>'_blank'));?></li>
                <li style="padding-bottom: 3px;"><?php echo CHtml::link('Visitanos en youtube', 'http://www.youtube/jleod7', array('class'=>'btn btn-large','style'=>'color:white;','target'=>'_blank'));?></li>
                <li style="padding-bottom: 3px;"><?php echo CHtml::link('Siguenos en Twitter', 'http://www.twitter.com/jleod7', array('class'=>'btn btn-large','style'=>'color:white;','target'=>'_blank'));?></li>
                <li style="padding-bottom: 3px;"><?php echo CHtml::link('Visita Nuestra Web', 'http://www.elaprendiz.net63.net', array('class'=>'btn btn-large','style'=>'color:white;','target'=>'_blank'));?></li>
                <li style="padding-bottom: 3px;"><?php echo CHtml::link('Visita Nuestro Blog', 'http://www.javanoesdificil.blogspot.com', array('class'=>'btn btn-large','style'=>'color:white;','target'=>'_blank'));?></li>
            </ul>
            <p>Tambien puedes hacer una pequeña donación</p>
        </div> 
    </div>
</div>

<?php 

if(!$cookie or is_null($cookie)){
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
      'id'=>'aviso',
      // additional javascript options for the dialog plugin
      'options'=>array(
          'title'=>'AVISO',
          'autoOpen'=>false,
          'width'=>'42%',
      ),    
  ));

?>
<div class="portlet span-10 categorias"> 
    <div class="portlet-content">
Para acceder a esta sección de esta web debes estar de acuerdo con lo siguiente.
<ol class="daviso">
    <li> El contenido de esta seccion es solamente para publico adulto, no debe ser visto por menores de edad.
        si tu eres menor de edad o es ilegal para ti acceder a imagenes y lenguaje de contenido adulto. NO ACCEDAS.
    </li>
    
    <li> Esta seecion de muestra tal y como es sin garantia expresa o implicita. si das en "Estoy de acuerdo" tu estas de acuerdo que chimboteenjuerga 
    no es responsable de ningun daño por el uso de esta sección.</li>
    
    <li> Como condicion de uso de esta seccion, tu debes entender y cumplir las normas de chimboteenjuerga, normas que cuales puedes encontrar en el enlace de normas de la web.</li>
</ol> 
    
<?php

    echo CHtml::link('Estoy de acuerdo', array('//anonimo','ctg'=>'General'), array('class'=>'btn btn-small','style'=>'color:white;','onclick'=>'document.cookie="uacep=usuario"'));
    echo CHtml::link('Cancelar', array('#'), array('class'=>'btn btn-small','style'=>'float:right; color:white;')); 

?>
</div>
</div>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); 
    }
?>