<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 01.10.2015
 * Time: 16:00
 */
Yii::app()->clientScript->registerScript(
    'timer',
    ''
);
$user = Yii::app()->user->getUser();
$currentTimer = $user->userActiveTime;
if ($currentTimer) {

} else {
    $currentTimer = new UserTime();
}
?>
<li class="dropdown">
    <div <?php if ($currentTimer->isNewRecord):?>style="display: none" <?php endif;?>>
        <input class="form-control input-sm"/>
        <span class="fa fa-play"></span>
    </div>
    <div <?php if (!$currentTimer->isNewRecord):?>style="display: none" <?php endif;?>>
        <span><?php echo $currentTimer->getCurrentTime();?></span>
    </div>

    <ul class="dropdown-menu dropdown-alerts">
        <li>
            <a href="mailbox.html">
                <div>
                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                    <span class="pull-right text-muted small">4 minutes ago</span>
                </div>
            </a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="profile.html">
                <div>
                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                    <span class="pull-right text-muted small">12 minutes ago</span>
                </div>
            </a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="grid_options.html">
                <div>
                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                    <span class="pull-right text-muted small">4 minutes ago</span>
                </div>
            </a>
        </li>
        <li class="divider"></li>
        <li>
            <div class="text-center link-block">
                <a href="notifications.html">
                    <strong>See All Alerts</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </li>
    </ul>
</li>

