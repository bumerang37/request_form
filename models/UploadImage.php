<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 10.06.2019
 * Time: 10:30
 */

namespace app\models;

use yii\base\Model;


class UploadImage extends Model
{
    public $image;

    public function rules()
    {
        return [
            [['image'], 'file', 'extensions' => 'png, jpg'],
        ];
    }



    public function upload() {
        if ($this->validate()) {
           $this->image->saveAs("uploads/{$this->image->basename}.{$this->image->extension}");
        } else {
            return false;
        }
    }
}