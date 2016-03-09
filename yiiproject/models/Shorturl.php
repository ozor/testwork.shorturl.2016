<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\BaseUrl;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "shorturl".
 *
 * @property integer $id
 * @property string $code
 * @property string $url
 */
class Shorturl extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shorturl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'url'], 'string'],
        ];
    }

    public function generateUrlCode() {
        $random_string = implode('', array_rand(array_flip(array_merge(range('a','z'), range('A','Z'))), rand(4, 12)));
        $check = $this->findOne(['url' => $this->url]);
        return ( empty($check) ) ? $random_string : $this->generateUrlCode();
    }
}