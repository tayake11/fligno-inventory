<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipmentlist extends Model
{
    protected $guarded = [

    ];
    public function type() {
    	return $this->hasOne('App\EquipmentType','id','equipment_type_id');
    }

    public function specificationDetails(){
    	return $this->hasMany('App\SpecificationDetail','equipment_list_id');
    }

    public function getSdAttribute($value)
    {
       	$payload = [];

    	foreach($this->specificationDetails as $item) {

    		$payload[$item->specification->name] = ['specification' => $item->id,'detail'=>$item->detail];
    	}
    	return json_encode($payload);
    }

}
