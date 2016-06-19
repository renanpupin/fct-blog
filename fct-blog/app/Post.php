<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "post";

    protected $fillable = [
        'title',
        'slug',
        'content',
        'feature_img',
        'id_category',
        'id_user'
    ];

    public function category(){
        return $this->belongsTo('\App\Category', 'id_category', 'id');
    }

    public function user(){
        return $this->belongsTo('\App\User');
    }
}
