<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use Session;

class AdminTagsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $tags = Tag::orderBy('name', 'asc')->paginate(10);
        return view('admin.pages.manage-tags')->withTags($tags);
    }


    public function store(Request $request)
    {
        //validate
        $this->validate($request, array(
            'name' => 'required|min:3|unique:tags',
            'description' => 'nullable|min:10'
        ));

        $tag = new Tag;
        $tag->name = $request->name;
        $tag->description = $request->description;
        $tag->slug = str_slug($request->name, '-');
        $tag->save();
        Session::flash('success', 'Tag has added successfully');
        return redirect()->route('admin.manage_tags');
    }


    public function edit($id)
    {
        //find the tag
        $tag = tag::find($id);
        return view('admin.pages.edit-tag')->withtag($tag);
    
    }

    public function update(Request $request, $id)
    {
        $tag = Tag::find($id);

        //validate
        if ($tag->name == $request->name) {
            $this->validate($request, array(
                'name' => 'required|min:3',
                'description' => 'min:10'
            ));
        }else {
            $this->validate($request, array(
                'name' => 'required|min:3|unique:tags',
                'description' => 'min:10'
            ));
        }
        //Store
        $tag->name = $request->name;
        $tag->description = $request->description;
        $tag->slug = str_slug($request->name, '-');
        $tag->save();
        Session::flash('success', 'Tag has updated successfully');
        return redirect()->route('admin.manage_tags');
    }


    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();
        Session::flash('success', 'Tag has deleted successfully');
        return redirect()->route('admin.manage_tags');
    }
}
