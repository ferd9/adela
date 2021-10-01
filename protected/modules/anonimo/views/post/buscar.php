<div class="btn btn-mediun" style="float:right;">
<?php

echo CHtml::beginForm(Yii::app()->getController()->createUrl('post/index'),'GET', array());
echo CHtml::label('Buscar contenido: ', 'wsearch');
echo CHtml::textField('wsearch','',array('size'=>'38px'));
echo CHtml::submitButton('Buscar');
echo CHtml::endForm();
?>
</div>
