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

    public function getSdAttribute()
    {
       	$payload = [];
        foreach($this->type->specificationlist as $item) {
            if($item !== null) {
                $payload[$item->name] = [];
            }

        }
    	foreach($this->specificationDetails as $item) {
            if ($item->specification != null ){
                if(array_key_exists($item->specification->name,$payload)){
                    array_push(
                        $payload[$item->specification->name],
                        ['specification' => $item->id ,'detail'=>$item->detail]
                    );
                }
            }
    	}
    	foreach($payload as $key => $item){
            if( sizeof($item) == 0 ) {
                array_push(
                    $payload[$key],
                    ['specification' => null ,'detail' => '']
                );
            }
        }
    	return json_encode($payload);
    }

}
