<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hero".
 *
 * @property integer $id
 * @property string $name
 * @property string $kda
 * @property string $icon
 */
class Hero extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hero';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'icon'], 'required'],
            [['name', 'icon'], 'string', 'max' => 255],
            //[['kda'], 'match', 'pattern' => '/^[0-9][2]\/[0-9][2]\/[0-9][2]$/'],
            [['icon'], 'unique'],
            [['name'], 'unique'],
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
            'name' => 'Имя',
            //'kda' => 'К/Д/А',
            'icon' => 'Иконка',
        ];
    }
}
