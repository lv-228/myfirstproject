<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "translation".
 *
 * @property integer $id
 * @property string $name
 * @property string $start_date
 * @property boolean $status
 * @property string $data_create
 * @property integer $moder_id
 * @property integer $smoder_id
 *
 * @property Message[] $messages
 * @property Moderator $moder
 * @property Strongmoderator $smoder
 */
class Translation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'start_date', 'status', 'data_create',], 'required'],
            [['status'], 'boolean'],
            [['moder_id', 'smoder_id'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['start_date', 'data_create'], 'string', 'max' => 20],
            [['name'], 'unique'],
            [['name'],'match', 'pattern' =>  '/^[А-ЯA-Za-zа-я0-9\/!?()*., ]{1,30}$/u','message' => 'Недопустимые символы!'],
            [['moder_id'], 'exist', 'skipOnError' => true, 'targetClass' => Moderator::className(), 'targetAttribute' => ['moder_id' => 'id']],
            [['team_a_id'], 'exist', 'skipOnError' => true, 'targetClass' => Team::className(), 'targetAttribute' => ['team_a_id' => 'id']],
            [['team_b_id'], 'exist', 'skipOnError' => true, 'targetClass' => Team::className(), 'targetAttribute' => ['team_b_id' => 'id']],
            [['team_a_score'],'default', 'value' => 0],
            [['team_b_score'],'default', 'value' => 0],
            [['delete'],'default','value'=>false],
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
            'start_date' => 'Дата начала',
            'status' => 'Включена',
            'data_create' => 'Дата создания',
            'moder' => 'Модератор',
            'smoder_id' => 'Супер модератор',
            'team_a_id' => 'Команда А',
            'team_b_id' => 'Команда B',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['trans_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModer()
    {
        return $this->hasOne(Moderator::className(), ['id' => 'moder_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmoder()
    {
        return $this->hasOne(Strongmoderator::className(), ['id' => 'smoder_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getTeama()
    {
        return $this->hasOne(Team::className(), ['id' => 'team_a_id']);
    }

    public function getTeamb()
    {
        return $this->hasOne(Team::className(), ['id' => 'team_b_id']);
    }

    public function main()
    {
        $urlstr = $_SERVER['REQUEST_URI'];

        $trid = '?trans_id';

        $pos = strripos($urlstr, $trid);

        $pos<1 ? $bool = true : $bool = false;

        return $bool;
    }

    public function indexSql()
    {
    $SQL['chosetrans'] = Translation::find()->where(['id'=> (int)$_GET['trans_id']])->one();

      $_SESSION['transname'] = $SQL['chosetrans']->name;

      $_SESSION['transname'] = $SQL['chosetrans']->name;

      $_SESSION['thistrans'] = '?trans_id='.(int)$_GET['trans_id'];

      $_SESSION['thistransid'] = (int)$_GET['trans_id'];

    $SQL['team_players_a'] = Player::find()->where('team_id' == $SQL['chosetrans']->team_a_id)->all();

    $SQL['team_players_b'] = Player::find()->where('team_id' == $SQL['chosetrans']->team_b_id)->all();

    $SQL['listmess'] = Message::find()->where(['trans_id' => (int)$_GET['trans_id']])->orderBy(['(date_time)' => SORT_ASC])->all();

    $SQL['all_heroes'] = Hero::find()->asArray()->all();

      return $SQL;
    }
}
