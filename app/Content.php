<?php

namespace App;

use Carbon\Carbon;
use Cviebrock\EloquentTaggable\Taggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Content extends Model
{
    use Taggable;

    protected $table = 'content';

    protected $primaryKey = 'id';

    protected $fillable = ['text_title','description','full_text','cat_id','create_date','member_id','display','count','feature','publish_date','media','media_title','media_publish','tag','type','icon','delete_statue'];

    protected $attributes = ['count'=>0,'delete_statue'=>0,'icon'=>0,'media_title'=>'','display'=>0,'feature'=>0,'type'=>1];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('status', function (Builder $builder) {
            $builder->where('publish_date','<=', Carbon::now())
                ->where('delete_statue',0)
                ->where('display',1)
                ->orderBy('publish_date','desc');
        });
    }

    public function getMenu(){
        return $this->belongsTo(Menu::class,'cat_id','c_id');
    }

    public function getAuthor(){
        return $this->belongsTo(User::class,'member_id','id');
    }

    public $timestamps = false;
}
