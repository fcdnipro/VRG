<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $book_title
 * @property string|null $short_description
 * @property string|null $picture_path
 * @property string|null $authors_id
 * @property string $publication_date
 */
class Book extends \yii\db\ActiveRecord
{
    public $imageFile;
    public $authors;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_title', 'authors_id', 'publication_date'], 'required'],
            [['publication_date'], 'safe'],
            [['book_title', 'short_description', 'picture_path'], 'string', 'max' => 255],
            [['picture_path'], 'unique'],
            [['imageFile'], 'file', 'extensions' => 'png, jpg','maxSize' => 2*1024*1024],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_title' => 'Book Title',
            'short_description' => 'Short Description',
            'picture_path' => 'Picture Path',
            'authors_id' => 'Authors',
            'publication_date' => 'Publication Date',
        ];
    }

    public function getAuthorName() {
        $tar = $this->authors_id;
        $author = Author::find()->select(['id','first_name','last_name'])->asArray()->all();
        $new_tar = explode(',', $tar);
        $name_tar = [];
        foreach ($author as $val)
        {
            if(in_array($val['id'],$new_tar)){
                $name_tar[] = $val['first_name'] . ' ' . $val['last_name'];
            }
        }
        $name_tar = implode(',', $name_tar);
        return $name_tar;
    }
}
