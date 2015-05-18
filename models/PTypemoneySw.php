<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "p_typemoney_sw".
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property string $detail
 * @property string $status
 */
class PTypemoneySw extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'p_typemoney_sw';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'code', 'name', 'detail'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'detail' => 'Detail',
            'status' => 'Status',
        ];
    }
}
