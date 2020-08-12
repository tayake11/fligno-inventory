<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specification;


class SpecificationController extends Controller
{
     public function delete($id)
    {
        $specificationlist = Specification::find($id);
        $specificationlist->delete();
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        
        $specificationlist = Specification::find($id);
        $specificationlist->name = $request->input('itemName');
        $specificationlist->save();
      
        return redirect()->back();
    }

    public function store(Request $request, $id)
    {
        $request->validate([
        'newSpecificationName' => ['required'],
        
        ],
        [
           
            'newSpecificationName.required' => 'Specification name is empty!',

        ] 
        );

        $specificationlist = new Specification();
        $specificationlist->name = $request->newSpecificationName;
        $specificationlist->equipment_type_id = $id;
        $specificationlist->save();

        return redirect()->back();

    }

}
