<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;

class AdminCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->paginate(10);
        return view('admin.pages.manage-categories')->withCategories($categories);
    }


    public function store(Request $request)
    {
        //validate
        $this->validate($request, array(
            'name' => 'required|min:3|unique:categories',
            'description' => 'min:10'
        ));

        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->slug = str_slug($request->name, '-');
        $category->save();
        Session::flash('success', 'Category has added successfully');
        return redirect()->route('admin.manage_categories');
    }


    public function edit($id)
    {
        //find the category
        $category = Category::find($id);
        return view('admin.pages.edit-category')->withCategory($category);
    
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        //validate
        if ($category->name == $request->name) {
            $this->validate($request, array(
                'name' => 'required|min:3',
                'description' => 'min:10'
            ));
        }else {
            $this->validate($request, array(
                'name' => 'required|min:3|unique:categories',
                'description' => 'min:10'
            ));
        }
        //Store
        $category->name = $request->name;
        $category->description = $request->description;
        $category->slug = str_slug($request->name, '-');
        $category->save();
        Session::flash('success', 'Category has updated successfully');
        return redirect()->route('admin.manage_categories');
    }


    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        Session::flash('success', 'Category has deleted successfully');
        return redirect()->route('admin.manage_categories');
    }
}
