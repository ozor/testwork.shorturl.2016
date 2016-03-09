<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

/**
 * This is the model class for table "shorturl".
 *
 * @property integer $id
 * @property string $code
 * @property string $url
 */
class Shorturl extends Model
{
    /**
     * @var string
     */
    protected $table = 'shorturl';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'url',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function generateUrlCode() {
        $random_string = implode('', array_rand(array_flip(array_merge(range('a','z'), range('A','Z'))), rand(4, 12)));
        $check = Shorturl::where('url', '=', $this->url)->first();
        return ( empty($check) ) ? $random_string : $this->generateUrlCode();
    }
}