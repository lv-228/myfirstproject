<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "advertiser".
 *
 * @property integer $id
 * @property string $name
 * @property string $other
 *
 * @property Banner[] $banners
 */
class Advertiser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'advertiser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 30],
            [['other'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Айди',
            'name' => 'Название',
            'other' => 'Другое',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanners()
    {
        return $this->hasMany(Banner::className(), ['advertiser_id' => 'id']);
    }
}
