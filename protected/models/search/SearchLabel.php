<?php

/**
* This is the model class for table "label".
*
* The followings are the available columns in table 'label':
    * @property string $id
    * @property string $company_id
    * @property string $title
    * @property string $color
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property Company $company
            * @property PageLabel[] $pageLabels
    */
class SearchLabel extends CLabel {

public function search() {

$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

return new CActiveDataProvider($this, array(
'criteria'=>$criteria,
'pagination'=>array('pageSize'=>40)
));
}

}
