<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clndr_access".
 *
 * @property integer $id
 * @property integer $user_owner
 * @property integer $user_guest
 * @property string $date
 *
 * @property ClndrUser $userOwner
 * @property ClndrUser $userGuest
 */
class Access extends \yii\db\ActiveRecord
{
    const ACCESS_CREATOR = 1;
    const ACCESS_GUEST = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clndr_access';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_owner', 'user_guest'], 'required'],
            [['user_owner', 'user_guest'], 'integer'],
            [['date'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_owner' => Yii::t('app', 'User Owner'),
            'user_guest' => Yii::t('app', 'User Guest'),
            'date' => Yii::t('app', 'Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'user_owner']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserGuest()
    {
        return $this->hasOne(User::className(), ['id' => 'user_guest']);
    }

    /**
     * Check access current user
     * @param Calendar $model
     * @return bool|int
     */
    public static function checkAccess($model)
    {
        if($model->creator == Yii::$app->user->id)
        {
            return self::ACCESS_CREATOR;
        }
        $accessCalendar = self::find()
            ->withGuest(Yii::$app->user->id)
            ->withDate($model->date_event)
            ->exists();
        if($accessCalendar)
            return self::ACCESS_GUEST;

        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendar()
    {
        return $this->hasMany(Calendar::className(), ['date' => 'date_event']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasMany(User::className(), ['user_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\AccessQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\AccessQuery(get_called_class());
    }
}
