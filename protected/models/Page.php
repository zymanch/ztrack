<?php
/**
 * Class Page
 * @property Label[] $labels
 * @property UserPage[] $userPages
 * @property UserPage $assignedUserPage
 */
class Page extends CPage {


    public function behaviors() {
        return array_merge(
            parent::behaviors(),
            array(
                'fillCreateColumn' => array(
                    'class' => 'FillCreateColumnBehavior'
                )
            )
        );
    }

    public function _extendedRelations() {
        return array(
            'labels' => array(self::MANY_MANY, 'Label', 'page_label(page_id,label_id)'),
            'messages' => array(self::MANY_MANY, 'Message', 'page_message(page_id,message_id)'),
            'userPages' => array(self::HAS_MANY, 'UserPage', 'page_id','order'=>'userPages.position ASC'),
            'assignedUserPage' => array(self::HAS_ONE, 'UserPage', 'page_id','on'=>'assignedUserPage.is_assigned="'.UserPage::IS_ASSIGNED.'"'),
        );
    }

    public function getCssClass() {
        if ($this->level->weight < 10) {
            return 'low';
        } else if ($this->level->weight < 20) {
            return 'normal';
        } else if ($this->level->weight < 30) {
            return 'high';
        } else if ($this->level->weight < 30) {
            return 'urgent';
        }
        return 'immediately';
    }

    protected function instantiate($attributes)
    {
        switch ($attributes['page_type_id']) {
            case PAGE_TYPE_NOTES:
                return new NotePage(null);
            case PAGE_TYPE_WIKI:
                return new WikiPage(null);
            case PAGE_TYPE_RELEASE:
                return new ReleasePage(null);
            case PAGE_TYPE_TICKETS:
                return new TicketPage(null);
        }
        throw new Exception('Undefined page type: '.$attributes['page_type_id']);
    }

    public function getTitle() {
        return $this->title;
    }
    /**
     * @return Page
     */
    public function getTopPage() {
        $parent = $this;
        while ($parent->parentPage) {
            $parent = $parent->parentPage;
        }
        return $parent;
    }

    public function getParentsList($invert = true) {
        $parent = $this->parentPage;
        $result = array();
        while ($parent) {
            $result[] = $parent;
            $parent = $parent->parentPage;
        }
        if ($invert) {
            return array_reverse($result);
        }
        return $result;
    }

    public function getBodyAsHtml() {
        return Yii::app()->user->getEditor()->parse($this->body);
    }

    public function getCommentsProvider() {
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'pageMessage'=>array('select' => false)
        );
        $criteria->compare('pageMessage.page_id',$this->id);
        $criteria->order = 't.created DESC';
        return new CActiveDataProvider('Message',array(
            'criteria' => $criteria,
            'pagination' => array('pageSize'=>40)
        ));
    }

    /**
     * @param $userId
     * @return UserPage
     */
    public function getOrCreateUserPage($userId) {
        $attributes = array(
            'page_id' => $this->id,
            'user_id' => $userId
        );
        $link = UserPage::model()->findByAttributes($attributes);
        if ($link) {
            return $link;
        }
        $link = new UserPage();
        $link->attributes = $attributes;
        $link->position = 0;
        $isAlreadyAssigned = false;
        $assignedPosition = 0;
        foreach ($this->userPages as $userPage) {
            if ($isAlreadyAssigned) {
                $link->position = round(($userPage->position + $assignedPosition)/2);
                break;
            }
            if ($userPage->is_assigned == UserPage::IS_ASSIGNED) {
                $isAlreadyAssigned = true;
                $assignedPosition = $userPage->position;
            }
            $link->position = $userPage->position + 1000;
        }
        $link->save(false);
        return $link;
    }
}