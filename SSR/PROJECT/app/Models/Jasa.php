<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    //
    protected $table = 'jasa';
    protected $primaryKey = 'jasa_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['user_id','jasa_name','jasa_descPrice','jasa_price','jasa_days','kat_skill_id','jasa_desc','jasa_req','jasa_img'];
    // protected $fillable = ['jasa_name','jasa_descPrice','jasa_price','kat_skill_id','jasa_desc','jasa_req','jasa_img'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category(){
        return $this->hasOne(Category::class,'category_id','kat_skill_id');
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class, 'wishlist_id_jasa', 'id');
    }

    public function review(){
        return $this->hasMany(Review::class,'jasa_id','jasa_id');
    }

}
