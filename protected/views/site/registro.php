<div class="form portlet-content"> 

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuario-registro-form',
        'enableClientValidation'=>true,
        'htmlOptions'=>array('class'=>'formee'),
	'enableAjaxValidation'=>false,
)); ?>
    
    <fieldset>
        <legend>Registro</legend>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre'); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'apellidos'); ?>
		<?php echo $form->textField($model,'apellidos'); ?>
		<?php echo $form->error($model,'apellidos'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'verificarEmail'); ?>
		<?php echo $form->textField($model,'verificarEmail'); ?>
		<?php echo $form->error($model,'verificarEmail'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'clave'); ?>
		<?php echo $form->passwordField($model,'clave'); ?>
		<?php echo $form->error($model,'clave'); ?>
	</div>        

	<div class="row">
		<?php echo $form->labelEx($model,'sexo'); ?>
		<?php echo $form->dropDownList($model,'sexo',DefinidorTipos::listaSexo()); ?>
		<?php echo $form->error($model,'sexo'); ?>
	</div>
	
        
        <div class="row grid-3-12">
		<?php echo $form->labelEx($model,'dia'); ?>
		<?php echo $form->dropDownList($model,'dia',DefinidorTipos::dias());?>
		<?php echo $form->error($model,'dia'); ?>         
            
	</div>
        <div class="row grid-4-12">            
                <?php echo $form->labelEx($model,'mes'); ?>
		<?php echo $form->dropDownList($model,'mes',DefinidorTipos::meses()); ?>
		<?php echo $form->error($model,'mes'); ?>
        </div>    
         <div class="row grid-4-12">            
                
                <?php echo $form->labelEx($model,'anio'); ?>
		<?php echo $form->dropDownList($model,'anio',DefinidorTipos::anios()); ?>
		<?php echo $form->error($model,'anio'); ?>
        </div>
	

	<div class="row">		
		<?php echo $form->hiddenField($model,'fecha_reg',array('value'=>time())); ?>
		<?php echo $form->error($model,'fecha_reg'); ?>
	</div>

	<div class="row">
		
		<?php echo $form->hiddenField($model,'banneado',array('value'=>'0')); ?>
		<?php echo $form->error($model,'banneado'); ?>
	</div>	


	<div class="row buttons">
		<?php echo CHtml::submitButton('Registrarse'); ?>
	</div>
</fieldset>
<?php $this->endWidget(); ?>

</div><!-- form -->