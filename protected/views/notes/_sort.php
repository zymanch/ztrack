<?php
/* @var $this NotesController */
/* @var $data Page */
?>
<li class="dd-item" data-id="1">
    <div class="dd-item ">
        <div class="dd-handle"><?php echo CHtml::encode($data->title);?></div>
    </div>
    <?php if ($data->childPages):?>
        <ol class="dd-list">
            <?php foreach ($data->childPages as $childPage):?>
                <?php $this->renderPartial('_sort',array('data'=>$childPage));?>
            <?php endforeach;?>
        </ol>
    <?php endif;?>
</li>