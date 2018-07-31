<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';

    protected $primaryKey = 'c_id';

    protected $fillable = ['c_title', 'c_is_show','delete_statue','ordering'];

    protected $attributes = ['delete_statue'=>0];

    public function getContents(){
        return $this->hasMany(Content::class,'cat_id','c_id');
    }

    public $timestamps = false;
}
