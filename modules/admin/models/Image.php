<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property string $title
 * @property int $post_id
 *
 * @property Post $post
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'post_id'], 'required'],
            [['post_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'post_id' => 'Post ID',
        ];
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::class, ['id' => 'post_id']);
    }

    public function CreateImages($title, $id)
    {
        if (empty($title)) return false;
        foreach ($title as $item) {
            $this->id = null;
            $this->isNewRecord = true;
            $this->title = $item;
            $this->post_id = $id;
            if (!$this->save()) {
                return false;
            }
        }
        return true;
    }

    public static function deleteImages($post)
    {
        $images = $post->getImages()->asArray()->all();
        foreach ($images as $image) {
            unlink( Yii::$app->basePath . "/web/{$image['title']}");
        }
        $post->unlinkAll('images', true);
    }
}
