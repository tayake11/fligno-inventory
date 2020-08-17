<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EquipmentType;
use App\Specification;


class EquipmentTypeController extends Controller
{

    public function index()
    {
        $equipmenttype = EquipmentType::all();

        return view('equipmenttype.index',
        	['equipmenttypes'=>$equipmenttype] );
    }

    public function create()
    {
        $equipmenttype = EquipmentType::all();
        return view('equipmenttype.create',
        	['equipmenttypes'=>$equipmenttype]);
    }

    public function store(Request $request)
    {

        $request->validate([
        'equipmentTypeName' => ['required', 'unique:equipment_types,equipment_name'],

        ],
        [
            'equipmentTypeName.unique' => 'Equipment Category already Exist!',

            'equipmentTypeName.required' => 'Equipment Category name is empty!',

        ]
        );



        $equipmenttype = new EquipmentType();
        $equipmenttype->equipment_name = $request->input('equipmentTypeName');
        $equipmenttype->save();

        foreach($request->specification as $specification){

            $item = new Specification;

            $item->create([
                'name'=>$specification,
                'equipment_type_id'=>$equipmenttype->id,
            ]);


        }

        return redirect('/');
    }

    public function delete($id)
    {
        $equipmenttype = EquipmentType::find($id);
        $equipmenttype->delete();
        return redirect('/');
    }

    public function show($id)
    {

    	$equipmenttype = EquipmentType::findOrFail($id);
        $equipmenttypes = EquipmentType::all();
        // dd($equipmenttype->equipment->first()->specificationDetails);
        return view('equipmentlist.showlist',[
            'equipmenttypes'=>$equipmenttypes,
            'equipmenttype'=> $equipmenttype,
            ]);
    }

    // public function edit($id)
    // {
    //     $equipmenttype = EquipmentType::find($id);
    //     $equipmenttypes = EquipmentType::all();
    //     return view('equipmenttype',[
    //         'equipmenttypes'=>$equipmenttypes,
    //         'equipmenttype'=> $equipmenttype,
    //         'layout'=>'edit']);
    // }

    public function update(Request $request, $id)
    {

        $equipmenttype = EquipmentType::find($id);
        $equipmenttype->equipment_name = $request->input('equipmentTypeName');
        $equipmenttype->save();

        return redirect('/show/'.$equipmenttype->id);
    }
}
