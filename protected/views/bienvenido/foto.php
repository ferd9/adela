<?php if(Yii::app()->user->hasFlash('foto_perfil')){?>
<div class="flash-success"><?php echo Yii::app()->user->getFlash('foto_perfil')?></div>
<?php } ?>
<div class="portlet span-18">
    <div class="portlet-header"><h4>Foto para tu perfil(RECOMENDADO)</h4></div>
    <div class="portlet-content"> 
        <div class="portlet span-6">
            <div class="portlet-content">
                <?php                
                    echo $foto;                   
                ?>
            </div>    
        </div>
        <div class="portlet span-10">
            <div class="portlet-content">
                <div class="form"> 

        <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'ufoto-registro-form',
                'enableClientValidation'=>true,
                'htmlOptions'=>array('enctype'=>'multipart/form-data','class'=>'formee'),
                'enableAjaxValidation'=>false,
        )); ?>

            <fieldset>               

                <?php echo $form->errorSummary($model); ?>

                <div class="uploader">
                        <?php echo $form->labelEx($model,'foto'); ?>
                        <?php echo CHtml::hiddenField('MAX_FILE_SIZE', '6291456'); ?>
                        <?php echo $form->fileField($model,'foto'); ?>
                        <?php echo $form->error($model,'foto'); ?>
                </div>               

                <div class="row buttons">
                        <?php echo CHtml::submitButton('Subir Foto'); ?>
                </div>
        </fieldset>
        <?php $this->endWidget(); ?>

        </div><!-- form -->
                <div class="clearfix"></div>
             <?php echo CHtml::link('Continuar',array('datos'),array('class'=>'btn btn-small'));?>   
               
            </div>    
        </div>  
        
    </div>          
</div> 
