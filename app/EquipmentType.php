<?php	

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipmentType extends Model
{
    protected $guarded = [

    ];

    public function equipment(){
    	return $this->hasMany('App\Equipmentlist', 'equipment_type_id', 'id');
    }

     public function specificationlist(){
    	return $this->hasMany('App\Specification');
    }
}
