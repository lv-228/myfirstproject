<?php

namespace app\models;
use yii\base\Model;
use yii\web\UploadedFile;

use Yii;

/**
 * This is the model class for table "player".
 *
 * @property integer $id
 * @property string $nick
 * @property string $icon
 * @property integer $team_id
 *
 * @property Team $team
 */
class Player extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'player';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nick', 'icon','team_id'], 'required'],
            [['team_id'], 'integer'],
            [['nick'], 'string', 'max' => 30],
            [['icon'], 'string', 'max' => 255],
            [['player_role'],'string','max' => 100],
            [['team_id'], 'exist', 'skipOnError' => true, 'targetClass' => Team::className(), 'targetAttribute' => ['team_id' => 'id']],
            [['hero_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hero::className(), 'targetAttribute' => ['hero_id' => 'id']],
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
            'nick' => 'Ник',
            'icon' => 'Иконка',
            'team_id' => 'Команда',
            'hero_id' => 'Герой',
            'player_role' => 'Роль',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeam()
    {
        return $this->hasOne(Team::className(), ['id' => 'team_id']);
    }

    public function getHero()
    {
        return $this->hasOne(Hero::className(), ['id' => 'hero_id']);
    }
}
