<?php

/**
* This is the model class for table "level".
*
* The followings are the available columns in table 'level':
    * @property string $id
    * @property string $type
    * @property string $title
    * @property string $css_class
    * @property string $company_id
    * @property integer $weight
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property Exception[] $exceptions
            * @property Company $company
            * @property Page[] $pages
    */
class SearchLevel extends CLevel {

    public function rules()	{
        return array(
            array('id, type, title, css_class, company_id, weight, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('css_class',$this->css_class,true);
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
