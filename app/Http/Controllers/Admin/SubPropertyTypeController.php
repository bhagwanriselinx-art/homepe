<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubPropertyType;
use Illuminate\Http\Request;

class SubPropertyTypeController extends Controller
{
    public function index()
    {
        $subTypes = SubPropertyType::with('category')->get();
        return view('admin.sub_property_type.index', compact('subTypes'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.sub_property_type.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'slug' => 'required|unique:sub_property_types',
            'status' => 'required'
        ]);

        SubPropertyType::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status
        ]);

        return redirect()->route('admin.sub-property-type.index')->with([
            'messege' => 'Sub Property Type Created Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function edit($id)
    {
        $subType = SubPropertyType::findOrFail($id);
        $categories = Category::all();

        return view('admin.sub_property_type.edit', compact('subType','categories'));
    }

    public function update(Request $request, $id)
    {
        $subType = SubPropertyType::findOrFail($id);

        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'slug' => 'required|unique:sub_property_types,slug,' . $subType->id,
            'status' => 'required'
        ]);

        $subType->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status
        ]);

        return redirect()->back()->with([
            'messege' => 'Sub Property Type Updated Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $subType = SubPropertyType::findOrFail($id);
        $subType->delete();

        return redirect()->route('admin.sub-property-type.index')->with([
            'messege' => 'Deleted Successfully',
            'alert-type' => 'success'
        ]);
    }
}