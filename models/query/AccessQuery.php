<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Access]].
 *
 * @see \app\models\Access
 */
class AccessQuery extends \yii\db\ActiveQuery
{
    /**
     * @param $user_guest
     * @return $this
     */
    public function withGuest($user_guest)
    {
        return $this->andWhere(
            'user_guest = :user_guest',
            [
                ":user_guest" => $user_guest
            ]
        );
    }
    /**
     * @param $date
     * @return $this
     */
    public function withDate($date)
    {
        return $this->andWhere(
            'date = :date',
            [
                ":date" => $date
            ]
        );
    }

    /**
     * @inheritdoc
     * @return \app\models\Access[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Access|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}