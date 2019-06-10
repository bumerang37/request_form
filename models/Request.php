<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * This is the model class for table "request".
 *
 * @property int $request_id
 * @property string $name
 * @property string $message
 * @property string $image
 * @property string $list
 * @property int $created_at
 * @property int $updated_at
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $listFields = [
        ['id' => '1', 'name' => 'Значение 1'],
        ['id' => '2', 'name' => 'Значение 2'],
        ['id' => '3', 'name' => 'Значение 3'],
        ['id' => '4', 'name' => 'Значение 4'],
        ['id' => '5', 'name' => 'Значение 5'],

    ];

    public static function tableName()
    {
        return '{{%request}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['created_at', 'updated_at'], 'integer'],
            [['name', 'message', 'list'], 'required'],
            [['name', 'message', 'image', 'list'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg, bmp'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'request_id' => Yii::t('app/forms','request_id'),
            'name' => Yii::t('app/forms', 'fio'),
            'message' => Yii::t('app/forms', 'message'),
            'list' => Yii::t('app/forms', 'list'),
            'image' => Yii::t('app/forms', 'image'),
            'created_at' => Yii::t('app/forms', 'created_at'),
            'updated_at' => Yii::t('app/forms', 'updated_at'),
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (isset($this->image)) {
            $this->image = UploadedFile::getInstance($this, 'image');
            if (is_object($this->image)) {
                $path = Url::to('@webroot/uploads/');
                BaseFileHelper::createDirectory($path . date('Y') . "/" . date('m') . "/" . date('d'), 0777, true);
                $image_fullpath = "/uploads/" . date('Y') . '/' . date('m') . '/' . date('d');
                $this->image->saveAs($path . date('Y') . '/' . date('m') . '/' . date('d') . '/' . $this->request_id . "_" . $this->image);   //saving img in folder
                $this->image = $image_fullpath . "/" . $this->request_id . "_" . $this->image;    //appending id to image name
                \Yii::$app->db->createCommand()
                    ->update('request', ['image' => $this->image], 'request_id = "' . $this->request_id . '"')
                    ->execute(); //manually update image name to db
            }
        }
    }

    public function afterDelete()
    {
        parent::afterDelete();

        if ($this->image) {
            @unlink(Yii::getAlias('@webroot').$this->image);
        }
    }

    public function getImage() {
        return ($this->image) ? $this->image : '';
    }


}
