<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Property;
use App\Models\Setting;
use Illuminate\Http\Request;
use Image;
use File;
use Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $categories = Category::all();
        $setting = Setting::first();
        $selected_theme = $setting->selected_theme;

        return view('admin.category', compact('categories','selected_theme'));
    }

    public function create()
    {
        $setting = Setting::first();
        $selected_theme = $setting->selected_theme;

        return view('admin.create_product_category', compact('selected_theme'));
    }

    public function store(Request $request)
{
    $rules = [
        'category_type' => 'required',
        'name' => 'required|unique:categories',
        'slug' => 'required|unique:categories',
        'status' => 'required',
    ];

    $customMessages = [
        'category_type.required' => 'Category type is required',
        'name.required' => trans('admin_validation.Name is required'),
        'name.unique' => trans('admin_validation.Name already exist'),
        'slug.required' => trans('admin_validation.Slug is required'),
        'slug.unique' => trans('admin_validation.Slug already exist'),
    ];

    $this->validate($request, $rules, $customMessages);

    $category = new Category();

    // Upload Image
    if ($request->image) {
        $extention = $request->image->getClientOriginalExtension();
        $image_name = 'category-' . time() . '-img.' . $extention;
        $image_path = 'uploads/custom-images/' . $image_name;

        Image::make($request->image)
            ->save(public_path('/') . $image_path);

        $category->image = $image_path;
    }

    // Save Data
    $category->category_type = $request->category_type;
    $category->name = $request->name;
    $category->slug = $request->slug;
    $category->status = $request->status;

    $category->save();

    return redirect()->route('admin.category.edit', [
        'category' => $category->id,
        'lang_code' => admin_lang()
    ])->with([
        'messege' => trans('admin_validation.Created Successfully'),
        'alert-type' => 'success'
    ]);
}
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.edit_category', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $rules = [
            'category_type' => 'required', // NEW
            'name' => 'required|unique:categories,name,' . $category->id,
            'slug' => 'required|unique:categories,slug,' . $category->id, // FIXED
            'status' => 'required',
        ];

        $customMessages = [
            'category_type.required' => 'Category type is required',
            'name.required' => trans('admin_validation.Name is required'),
            'name.unique' => trans('admin_validation.Name already exist'),
            'slug.required' => trans('admin_validation.Slug is required'),
            'slug.unique' => trans('admin_validation.Slug already exist'),
        ];

        $this->validate($request, $rules, $customMessages);

        // Update basic data
        $category->category_type = $request->category_type; // NEW
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;
        $category->save();

        // Update Icon
        if ($request->icon) {
            $old_logo = $category->icon;

            $extention = $request->icon->getClientOriginalExtension();
            $logo_name = 'category-' . time() . '.' . $extention;
            $logo_path = 'uploads/custom-images/' . $logo_name;

            Image::make($request->icon)
                ->save(public_path('/') . $logo_path);

            $category->icon = $logo_path;
            $category->save();

            if ($old_logo && File::exists(public_path('/') . $old_logo)) {
                unlink(public_path('/') . $old_logo);
            }
        }

        // Update Image
        if ($request->image) {
            $old_image = $category->image;

            $extention = $request->image->getClientOriginalExtension();
            $image_name = 'category-' . time() . '-img.' . $extention;
            $image_path = 'uploads/custom-images/' . $image_name;

            Image::make($request->image)
                ->save(public_path('/') . $image_path);

            $category->image = $image_path;
            $category->save();

            if ($old_image && File::exists(public_path('/') . $old_image)) {
                unlink(public_path('/') . $old_image);
            }
        }

        return redirect()->back()->with([
            'messege' => trans('admin_validation.Update Successfully'),
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $count = Property::where('property_type_id', $id)->count();

        if ($count == 0) {
            $category = Category::findOrFail($id);

            $old_logo = $category->icon;
            $old_image = $category->image;

            $category->delete();

            if ($old_logo && File::exists(public_path('/') . $old_logo)) {
                unlink(public_path('/') . $old_logo);
            }

            if ($old_image && File::exists(public_path('/') . $old_image)) {
                unlink(public_path('/') . $old_image);
            }

            return redirect()->route('admin.category.index')->with([
                'messege' => trans('admin_validation.Delete Successfully'),
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->route('admin.category.index')->with([
                'messege' => trans('admin_validation.In this item multiple property exist, so you can not delete this item'),
                'alert-type' => 'error'
            ]);
        }
    }

    public function changeStatus($id)
    {
        $category = Category::findOrFail($id);

        $category->status = $category->status == 1 ? 0 : 1;
        $category->save();

        return response()->json(
            $category->status == 1 
            ? trans('admin_validation.Active Successfully')
            : trans('admin_validation.Inactive Successfully')
        );
    }
}