<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    //
    protected $table = 'promotions';
    protected $guarded = [];

    public function images_th()
    {
        return $this->hasMany('App\Promotion_Image_TH', 'promotion_id', 'id');
    }
    public function images_en()
    {
        return $this->hasMany('App\Promotion_Image_EN', 'promotion_id', 'id');
    }
}
