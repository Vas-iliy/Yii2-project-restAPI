<?php

namespace app\modules\api\models;

use yii\db\ActiveRecord;

class News extends ActiveRecord
{
    public static function tableName()
    {
        return 'new';
    }

    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            ['title', 'string', 'length' => [1,10]],
        ];
    }

}