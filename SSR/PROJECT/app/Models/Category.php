<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'kategori';
    protected $primaryKey = 'kategori_id';
    public $incrementing = true;
    public $timestamps = false;

    public function skill(){
        return $this->belongsTo(Skill::class,'kategori_id','category_id');
    }

    public function jasa(){
        return $this->belongsTo(Jasa::class,'jasa_id','kat_skill_id');
    }

    public function requestbuyer(){
        return $this->hasMany(RequestBuyer::class,'category_id','category_id');
    }
}
