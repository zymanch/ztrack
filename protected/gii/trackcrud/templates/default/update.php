<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */

<?php
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));

?>


?>
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <h1>Правка <?php echo $this->modelClass." <?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?></h1>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-xs-12">

        <?php echo "<?php \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>

    </div>
</div>