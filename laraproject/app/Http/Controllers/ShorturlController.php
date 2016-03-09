<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Shorturl;
use Illuminate\Support\Facades\URL;

class ShorturlController extends Controller
{
    public function getUrl()
    {
        if (empty($_REQUEST['url'])) {
            echo json_encode([
                'success' => false,
                'message' => 'URL not found'
            ]);
            return null;
        }
        if ($this->checkPostUrl($_REQUEST['url'])) {
            // Check existence URL in Database
            $URL = Shorturl::where('url', '=', $_REQUEST['url'])->first();
            if ( !empty($URL)  ) {
                echo json_encode([
                    'success' => true,
                    'message' => URL::to('/', 'http') . $URL['code']
                ]);
            }
            else {
                $url_code = (new Shorturl())->generateUrlCode(); // Generate Unique URL code for short URL

                $insert = new Shorturl();
                $insert->code = $url_code;
                $insert->url = $_REQUEST['url'];
                $saved = $insert->save();

                if ( $saved ) {
                    echo json_encode([
                        'success' => true,
                        'message' => URL::to('/', 'http') . $url_code
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