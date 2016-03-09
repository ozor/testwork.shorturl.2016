<?php

namespace app\controllers;

use Yii;
use app\models\Shorturl;
use yii\helpers\BaseUrl;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAjax()
    {
        $model = new Shorturl();
        if (empty($_REQUEST['url'])) {
            echo json_encode([
                'success' => false,
                'message' => 'URL not found'
            ]);
            return null;
        }
        if ($this->checkPostUrl($_REQUEST['url'])) {
            // Check existence URL in Database
            $URL = Shorturl::findOne(['url' => $_REQUEST['url']]);
            if ( !empty($URL)  ) {
                echo json_encode([
                    'success' => true,
                    'message' => BaseUrl::to('/', 'http') . $URL['code']
                ]);
            }
            else {
                $url_code = $model->generateUrlCode(); // Generate Unique URL code for short URL

                $insert = new Shorturl();
                $insert->code = $url_code;
                $insert->url = $_REQUEST['url'];
                $saved = $insert->save();

                if ( $saved ) {
                    echo json_encode([
                        'success' => true,
                        'message' => BaseUrl::to('/', 'http') . $url_code
                    ]);
                }
                else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Error inserting CODE'
                    ]);
                    return null;
                }
            }
        }
        else {
            echo json_encode([
                'success' => false,
                'message' => 'Error validating Long URL'
            ]);
        }
        return null;
    }

    public function checkPostUrl($url) {
        return ( preg_match("#http[s]?://[-a-z0-9_.]+[-a-z0-9_:@&?=+,.!/~*'%$]*#i", trim($url), $matches) ) ? $matches[0] : false;
    }
}
