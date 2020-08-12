<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    protected $guarded = [

    ];
    public function detail(){
    	return $this->hasOne('App\SpecificationDetail');
    }
}
