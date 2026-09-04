<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChildSubPropertyType;
use App\Models\SubPropertyType;

class ChildSubPropertyTypeController extends Controller
{

    public function index()
    {
        $types = ChildSubPropertyType::with('subPropertyType')->latest()->get();
        return view('admin.child_sub_type.index', compact('types'));
    }

    public function create()
    {
        $subTypes = SubPropertyType::where('status',1)->get();
        return view('admin.child_sub_type.create', compact('subTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sub_property_type_id' => 'required|exists:sub_property_types,id',
            'name' => 'required|unique:child_sub_property_types,name',
        ]);

        ChildSubPropertyType::create([
            'sub_property_type_id' => $request->sub_property_type_id,
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
            'status' => $request->status ? 1 : 0,
        ]);

        return redirect()->route('admin.child-sub-type.index')
            ->with(['messege'=>'Created Successfully','alert-type'=>'success']);
    }

    public function edit($id)
    {
        $type = ChildSubPropertyType::findOrFail($id);
        $subTypes = SubPropertyType::where('status',1)->get();
        return view('admin.child_sub_type.edit', compact('type','subTypes'));
    }

    public function update(Request $request, $id)
    {
        $type = ChildSubPropertyType::findOrFail($id);

        $request->validate([
            'sub_property_type_id' => 'required|exists:sub_property_types,id',
            'name' => 'required|unique:child_sub_property_types,name,'.$type->id,
        ]);

        $type->update([
            'sub_property_type_id' => $request->sub_property_type_id,
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
            'status' => $request->status ? 1 : 0,
        ]);

        return redirect()->route('admin.child-sub-type.index')
            ->with(['messege'=>'Updated Successfully','alert-type'=>'success']);
    }

    public function destroy($id)
    {
        $type = ChildSubPropertyType::findOrFail($id);
        $type->delete();

        return redirect()->back()
            ->with(['messege'=>'Deleted Successfully','alert-type'=>'success']);
    }
}