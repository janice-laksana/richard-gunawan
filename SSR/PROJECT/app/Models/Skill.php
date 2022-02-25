<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skill';
    protected $fillable = ['user_id','kategori_id','skill_name'];
    public $timestamps = false;

    public function category(){
        return $this->hasOne(Category::class,'category_id','kategori_id');
    }
}
