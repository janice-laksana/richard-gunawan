<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    protected $table = 'sertifikat';
    protected $fillable = ['user_id','sertifikat_from','sertifikat_name','sertifikat_year'];
    public $timestamps = false;
}
