<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $middle_name
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            ['last_name','string','length' => [3]],
            [['first_name', 'last_name', 'middle_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'middle_name' => 'Middle Name',
        ];
    }

    public static function getAuthors(){
        $author = self::find()->select(['id','first_name','last_name'])->asArray()->all();
        $name = [];
        foreach ($author as $t){
            $key = $t['id'];
            $name[$key] = $t['first_name'] . ' ' . $t['last_name'];
        }
        return $name;
    }
}
