<?php
/**
 * Created by PhpStorm.
 * User: елена
 * Date: 08.03.2015
 * Time: 1:07
 * @var $this Controller
 */
?>

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <?php foreach (Yii::app()->user->getSystemModules() as $systemModule):?>
                <?php foreach ($systemModule->getMainMenuItems() as $menu):?>
                    <?php $this->renderPartial('//layouts/_mainMenuItem',array('menu'=>$menu));?>
                <?php endforeach;?>
            <?php endforeach;?>
        </ul>
    </div>
</nav>