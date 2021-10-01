<?php $this->widget('zii.widgets.CListView', array(
        'itemsTagName'=>'ul',
        'htmlOptions'=>array('class'=>'gallery'),
	'dataProvider'=>$criterio,
	'itemView'=>'_imagenespost',
        'template'=>'{summary}{pager}{items}\n',
        
)); ?>
<div class="clear"></div>
