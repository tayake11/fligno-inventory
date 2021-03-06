<?php

namespace App\Http\Controllers;

use App\Specification;
use Illuminate\Http\Request;
use App\Equipmentlist;
use App\EquipmentType;
use App\SpecificationDetail;

class EquipmentlistController extends Controller
{
    public function delete(Request $request, $id)
    {
        // dd($request->deleteId);
        $equipmentlist = Equipmentlist::findorfail($request['deleteId']);
        $equipmentlist->delete();

        $specificationDetail = SpecificationDetail::where('equipment_list_id', $id);
        $specificationDetail->delete();

        return redirect()->back();
    }

    public function create($id)
    {
        $equipmenttype = EquipmentType::find($id);
        return view('equipmenttype',
        	['equipmenttype'=>$equipmenttype,
         	'layout'=>'createitem']);
    }

    public function store(Request $request, $id)
    {

        $request->validate([
        'equipmentId' => ['required', 'unique:equipmentlists,equipment_id'],
        'serial' => ['required', 'unique:equipmentlists']
        ],
        [
            'equipmentId.unique' => 'ID is already Exist!',
            'serial.unique' => 'Serial already Exist!',
            'equipmentId.required' => 'ID is empty!',
            'serial.required' => 'Serial is empty!',

        ]
        );

        $item = new Equipmentlist();
        $item->equipment_id = $request->input('equipmentId');
        $item->brand = $request->input('brand');
        $item->model = $request->input('model');
        $item->serial = $request->input('serial');
        $item->equipment_type_id = $id;
        $item->save();

        foreach($request->specification as $key=>$detail){

            $detailcontainer = new SpecificationDetail;
            $detailcontainer->detail = $detail;
            $detailcontainer->equipment_list_id = $item->id;
            $detailcontainer->specification_id = $key;
            $detailcontainer->save();
        }
        return redirect('/show/'.$id)->with('Success','');


    }

    public function edit($id)
    {
        $item = Equipmentlist::find($id);
        return view('equipmenttype',[
            'equipment'=> $item,
            'layout'=>'edit']);
    }

    public function update(Request $request, $id)
    {
        $item = Equipmentlist::find($id);
        $item->equipment_id = $request->input('equipmentId');
        $item->brand = $request->input('brand');
        $item->model = $request->input('model');
        $item->serial = $request->input('serial');
        $item->save();

        foreach($request->specification as $key => $detail){
        $target = SpecificationDetail::find($key);
          if($target != null){
              $target->detail = $detail;
              $target->save();
          } else {
              $specificationId = Specification::where('name',$key)->first()->id;
              $newItem = new SpecificationDetail;
              $newItem->detail = $detail;
              $newItem->equipment_list_id = $item->id;
              $newItem->specification_id = $specificationId;
              $newItem->save();
          }
        }

        return redirect('/show/'.$item->type->id)->with('pagereturn',$request->pageid);
    }
}
