<?php
/**
 * Created by PhpStorm.
 * User: елена
 * Date: 05.04.2015
 * Time: 15:55
 * @var $dashboard_system_module DashboardSystemModule
 */
$systemModule = $dashboard_system_module->getSystemModule();
?>

<div class="widget red-bg p-lg text-center"  data-panel="widget_<?php echo $dashboard_system_module->id;?>">
    <h3>
        <?php echo $systemModule->getTitle();?>
            <?php echo CHtml::link(
                '<i class="fa fa-pencil"></i>',
                array(
                    'dashboard/configure',
                    'id'=>$dashboard_system_module->dashboard_id,
                    'dashboard_system_module_id' => $dashboard_system_module->id,
                ),
                array(
                    'class'=>'btn btn-xs',
                    'title'=>'Редактировать виджет'
                )
            );?>
            <?php echo CHtml::link(
                '<i class="fa fa-trash"></i>',
                array(
                    'dashboard/deleteWidget',
                    'id'=>$dashboard_system_module->dashboard_id,
                    'dashboard_system_module_id' => $dashboard_system_module->id,
                ),
                array(
                    'class'=>'btn btn-xs',
                    'title'=>'Удалить виджет'
                )
            );?>
    </h3>

    <div>
        <?php echo $systemModule->renderWidget();?>

    </div>
</div>
