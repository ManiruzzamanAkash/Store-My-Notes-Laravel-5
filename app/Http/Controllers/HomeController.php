<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use App\Category;
use App\Tag;
use Session;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getIndex', 'getAllPublicNotes', 'getSinglePublicNote']]);
    }


    public function getIndex()
    {
        return view('pages.index');
    }


    public function getAllPublicNotes(){
        $notes = Note::where('status', 1)
                ->orderBy('name', 'asc')
                ->get();
        return view('pages.allNotes')->withNotes($notes);
    }
    public function getSinglePublicNote($slug){
        $note = Note::where('slug','=', $slug)->first();

        return view('pages.singleNote')->withNote($note);
    }

    public function manageAllNotes(){

        $notes = Note::where('user_id','=', Auth::user()->id)->orderBy('updated_at', 'desc')->paginate(5);
        return view('pages.manage_notes')->withNotes($notes);
    }

    public function addNote(){
        $categories = Category::orderBy('name', 'asc')->get();
        // $categories = Category::where('active', 1)
        //        ->orderBy('name', 'ASC')
        //        ->take(10)
        //        ->get();

        // $tags = Tag::all();
        $tags = Tag::orderBy('name', 'asc')->get();
        return view('pages.addNote')->withCategories($categories)->withTags($tags);
        
    }



}
