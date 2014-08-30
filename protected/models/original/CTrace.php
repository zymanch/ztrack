<?php

/**
 * This is the model class for table "trace".
 *
 * The followings are the available columns in table 'trace':
 * @property string $id
 * @property string $request_id
 * @property string $parent_id
 * @property string $filename
 * @property integer $line
 * @property integer $method
 * @property string $position
 * @property string $status
 * @property string $changed
 *
 * The followings are the available model relations:
 * @property Request $request
 * @property CTrace $parent
 * @property CTrace[] $traces
 * @property TraceArgument[] $traceArguments
 * @property TraceCode[] $traceCodes
 */
class CTrace extends ActiveRecord {

	public function tableName()	{
		return 'trace';
	}

	public function rules()	{
		return array(
			array('position, changed', 'required'),
			array('line, method', 'numerical', 'integerOnly'=>true),
			array('request_id, parent_id, position', 'length', 'max'=>10),
			array('filename', 'length', 'max'=>255),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, request_id, parent_id, filename, line, method, position, status, changed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	protected function _baseRelations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'request' => array(self::BELONGS_TO, 'Request', 'request_id'),
			'parent' => array(self::BELONGS_TO, 'CTrace', 'parent_id'),
			'traces' => array(self::HAS_MANY, 'CTrace', 'parent_id'),
			'traceArguments' => array(self::HAS_MANY, 'TraceArgument', 'trace_id'),
			'traceCodes' => array(self::HAS_MANY, 'TraceCode', 'trace_id'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'request_id' => 'Request',
			'parent_id' => 'Parent',
			'filename' => 'Filename',
			'line' => 'Line',
			'method' => 'Method',
			'position' => 'Position',
			'status' => 'Status',
			'changed' => 'Changed',
		);
	}

	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('request_id',$this->request_id,true);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('line',$this->line);
		$criteria->compare('method',$this->method);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


}
