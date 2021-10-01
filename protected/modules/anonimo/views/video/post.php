<div class="f-registro portlet span-14">
<div class="form portlet-content">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'apost-post-form',
        'enableClientValidation'=>true,       
        'htmlOptions'=>array('enctype'=>'multipart/form-data','class'=>'formee'),
	'enableAjaxValidation'=>false,
        'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
    <fieldset>
        <legend>Postear</legend>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        <div class="row">
		<?php echo $form->labelEx($model,'user_nom'); ?>
		<?php echo $form->textField($model,'user_nom'); ?>
		<?php echo $form->error($model,'user_nom'); ?>
	</div>
        
	        
        <div class="row">
	<?php echo $form->labelEx($model,'imagen'); ?>
        <?php echo $form->textField($model,'imagen'); ?>
	<?php echo $form->error($model,'imagen'); ?>
        </div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo'); ?>
		<?php echo $form->error($model,'titulo'); ?>
	</div>	
	

	<div class="row">		
                <?php echo $form->labelEx($model,'etiquetas'); ?>
		<?php $this->widget('CAutoComplete', array(
			'model'=>$model,
			'attribute'=>'etiquetas',
			'url'=>array('suggestTags'),
			'multiple'=>true,
			'htmlOptions'=>array('size'=>50),
		)); ?>
		<p class="hint">Please separate different tags with commas.</p>
		<?php echo $form->error($model,'etiquetas'); ?>
            
            
            
                <?php echo $form->hiddenField($model,'tipo',array('value'=>DefinidorTipos::$TIPO_VIDEO)); ?>		
                <?php echo $form->hiddenField($model,'fecha',array('value'=>time())); ?>
        </div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'idcategoria'); ?>
		<?php echo $form->dropDownList($model,'idcategoria',  Acategoria::getListCategoria(),
                        array(
                    'options'=>array($model->idcategoria=>array('selected'=>true)                        
                    ),                    
                    'empty'=>'Categorias:')
                        ); ?>
		<?php echo $form->error($model,'idcategoria'); ?>
	</div>
        
        
        <?php if(Yii::app()->user->isGuest){
            if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'ccaptcha'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'ccaptcha'); ?>
		</div>
		<div class="hint" style="color: blue;">Genere un codigo nuevo y escriba el texto que se muestra</div>
		<?php echo $form->error($model,'ccaptcha'); ?>
	</div>
	<?php endif; 
        }?>
		<?php echo $form->hiddenField($model,'contrasenia',array('value'=>'123456')); ?>
		


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>
        </fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>
