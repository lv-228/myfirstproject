<?php

namespace app\models;
use yii\base\Model;
use yii\web\UploadedFile;

use Yii;

/**
 * This is the model class for table "banner".
 *
 * @property integer $id
 * @property string $link
 * @property string $image
 * @property integer $advertiser_id
 *  
 * @property Advertiser $advertiser
 * @property Duration[] $durations
 */
class Banner extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banner';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['link','image','advertiser_id'], 'required'],
            [['advertiser_id'], 'integer'],
            [['link', 'image'], 'string', 'max' => 255],
            [['advertiser_id'], 'exist', 'skipOnError' => true, 'targetClass' => Advertiser::className(), 'targetAttribute' => ['advertiser_id' => 'id']],
            [['imageFile'], 'image', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Айди',
            'link' => 'Ссылка',
            'image' => 'Изображение',
            'advertiser_id' => 'Рекламодатель',
            'imagefile' => 'Изображение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvertiser()
    {
        return $this->hasOne(Advertiser::className(), ['id' => 'advertiser_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDurations()
    {
        return $this->hasMany(Duration::className(), ['banner_id' => 'id']);
    }
}
