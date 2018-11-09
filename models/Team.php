<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

use Yii;

/**
 * This is the model class for table "team".
 *
 * @property integer $id
 * @property string $name
 * @property string $logo
 * @property integer $win_score
 * @property integer $lose_score
 */
class Team extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'team';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'logo', 'win_score', 'lose_score'], 'required'],
            [['win_score', 'lose_score'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['logo'], 'string', 'max' => 255],
            [['logo'], 'unique'],
            [['name'], 'unique'],
            [['win_score'],'match', 'pattern' =>  '/^[0-9]{1,4}$/u','message' => 'Только положительные числа!'],
            [['lose_score'],'match', 'pattern' =>  '/^[0-9]{1,4}$/u','message' => 'Только положительные числа, или слишком длинно!'],
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
            'name' => 'Имя команды',
            'logo' => 'Логотип',
            'win_score' => 'Кол-во побед',
            'lose_score' => 'Кол-во поражений',
        ];
    }
}
