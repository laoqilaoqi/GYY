<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    //
    protected $table = 'type';
    protected $primaryKey = 'type_id';
    protected $guarded = [];
    public $timestamps = false;


}
