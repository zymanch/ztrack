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
class CLevel extends ActiveRecord {

    public function tableName()	{
        return 'level';
    }

    public function rules()	{
        return array(
            array('title, weight', 'required'),
			array('weight', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>9),
			array('title, css_class', 'length', 'max'=>32),
			array('company_id', 'length', 'max'=>10)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'exceptions' => array(self::HAS_MANY, 'Exception', 'level_id'),
            'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
            'pages' => array(self::HAS_MANY, 'Page', 'level_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'type' => 'Type',
            'title' => 'Title',
            'css_class' => 'Css Class',
            'company_id' => 'Company',
            'weight' => 'Weight',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
