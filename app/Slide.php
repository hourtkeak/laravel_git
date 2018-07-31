<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $table = 'slide';

    protected $primaryKey = 'slide_id';

    protected $fillable = ['s_title','s_description','link','s_img','ordering'];

    protected $attributes = ['s_description'=>''];

    public $timestamps = false;
}
