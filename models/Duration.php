<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "duration".
 *
 * @property integer $id
 * @property string $start_date
 * @property string $end_date
 * @property integer $clicks_numbers
 * @property integer $show_numbers
 * @property integer $banner_id
 *
 * @property Banner $banner
 */
class Duration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'duration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clicks_numbers', 'show_numbers', 'banner_id'], 'integer'],
            [['start_date', 'end_date'], 'string', 'max' => 10],
            [['banner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Banner::className(), 'targetAttribute' => ['banner_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Айди',
            'start_date' => 'Дата начала',
            'end_date' => 'Дата окончания',
            'clicks_numbers' => 'Кол-во кликов',
            'show_numbers' => 'Кол-во показов',
            'banner_id' => 'Баннер',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanner()
    {
        return $this->hasOne(Banner::className(), ['id' => 'banner_id']);
    }

}
