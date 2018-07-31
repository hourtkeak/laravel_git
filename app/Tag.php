<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';
    protected $primaryKey = 't_id';
    protected $fillable = ['article_id','tag_cat_id','delete_status'];
    protected $attributes = ['delete_status'=>0];
    public $timestamps = false;

    public function getTitle(){
        return $this->belongsTo(Menu::class,'tag_cat_id','c_id');
    }
}
