<?php

/**
* This is the model class for table "exception".
*
* The followings are the available columns in table 'exception':
    * @property string $id
    * @property integer $title
    * @property string $level_id
    * @property string $total_count
    * @property string $trace_file
    * @property integer $trace_line
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property Level $level
*/
class CProjectException extends ActiveRecord {

    public function tableName()	{
        return 'exception';
    }

    public function rules()	{
        return array(
            array('title, level_id', 'required'),
			array('title, trace_line', 'numerical', 'integerOnly'=>true),
			array('level_id, total_count', 'length', 'max'=>10),
			array('trace_file', 'length', 'max'=>200),
			array('status', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'level' => array(self::BELONGS_TO, 'Level', 'level_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'level_id' => 'Level',
            'total_count' => 'Total Count',
            'trace_file' => 'Trace File',
            'trace_line' => 'Trace Line',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
