<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 12:00
 */
class TicketsProjectModule extends AbstractProjectModule {

    public function getModuleName() {
        return 'tickets';
    }

    public function getTabs() {
        return array(
            array(
                'label' => 'Tickets',
            )
        );
    }

    public function accessRules() {
        return  array_merge(
            array(
                array('allow',
                    'actions' => array('index'),
                    'users'=>array('*'),
                )
            ),
            parent::accessRules()
        );
    }

    public function actionIndex() {
        $this->renderPartial(
            '//modules/project/_tickets',
            array(
                'my_tickets_widget' => $this->_getMyTicketsWidget(),
                'second_widget' => $this->_getSecondWidget()
            )
        );
    }


    protected function  _getSecondWidget() {
        $projectId = Yii::app()->request->getParam('id');
        $widget = new LastReleaseWidgetModule();
        $widget->configure($projectId);
        if ($widget->haveItems()) {
            return $widget;
        }
        $widget = new TicketsWidgetModule();
        $page = new SearchPage();
        $page->project_id = Yii::app()->request->getParam('id');
        $widget->configure($page);
        return $widget;
    }


    protected function _getMyTicketsWidget() {
        $page = new SearchPage();
        $page->project_id = Yii::app()->request->getParam('id');
        $page->assign_user_id = Yii::app()->user->id;
        $widget = new TicketsWidgetModule();
        $widget->configure($page);
        return $widget;
    }

}