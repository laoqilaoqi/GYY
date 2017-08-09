<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    //
    protected $table = 'jd_type';
    protected $primaryKey = 'type_id';
    protected $guarded = [];
    public $timestamps = false;


}
