<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Note;
use App\Like;
use App\Dislike;
use App\Comment;
use App\Category;
use App\Tag;
use Session;
use Image;
use Purifier;
use App\Statistic;
use App\AdminNotification;
use Storage;

class NoteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'searchNote']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::where('status', 1)
        ->orderBy('updated_at', 'desc')
        ->paginate(5);
        return view('pages.allNotes')->withNotes($notes);
    }

    /**
     * Manage All Notes
     *
     * @return void view
     */
    public function manageAllNotes(){
        $notes = Note::where('user_id','=', Auth::user()->id)->orderBy('updated_at', 'desc')->paginate(5);
        return view('pages.manage_notes')->withNotes($notes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $tags = Tag::orderBy('name', 'asc')->get();
        return view('pages.addNote')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (Auth::user()->is_active == 1) {
        //Validate the note
            $this->validate($request, array(
                'title'         => 'required|min:3|max:190|unique:notes,title',
                'description'   => 'required|min:3',
                'category_id'   => 'required',
                'image'         => 'image',
            ));


        //Store the note
            $note = new Note;
            $note->title = $request->title;
            $note->slug = str_slug($note->title, '-');
            $note->description = Purifier::clean($request->description);
            $note->category_id = $request->category_id;
            $note->status = $request->status;
            $note->meta_keywords = $request->meta_keywords;
            $note->meta_description = $request->meta_description;
            $note->user_id = Auth::user()->id;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time(). '.'.$image->getClientOriginalExtension();
                $location = public_path('images/note_images/'.$filename);

            //Resize and upload
                Image::make($image)->resize(800, 400)->save($location);


                $note->image = $filename;
            }

            $note->save();

        //Sync with tags
            $note->tags()->sync($request->tags, false);

        //Add also in Statistics table
            $statistic = new Statistic;
            $statistic->note_id = $note->id;
            $statistic->save();



            Session::flash('success', 'Note has created successfully');
            return redirect()->route('index');
        }else {
            //User is banned
            Session::flash('ban_error', 'Sorry you are banned for some reason. Please request to admin and be an active user first');
            return redirect()->route('add_note');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {


        $note = Note::where('slug','=', $slug)->first();

        $comments = Comment::where('note_id', '=', $note->id);

        //Increase value in Statistics table
        $statistic = Statistic::where('note_id','=', $note->id)->first();
        $statistic->total_visits += 1;
        $statistic->save();
        
        if (Auth::check()) {
            $likes = DB::table('likes')
            ->where('note_id', $note->id)
            ->where('user_id', Auth::user()->id)
            ->get();

        }else{
            $likes = array();
        }

        if (Auth::check()) {
            $dislikes = DB::table('dislikes')
            ->where('note_id', $note->id)
            ->where('user_id', Auth::user()->id)
            ->get();

        }else{
            $dislikes = array();
        }
        return view('pages.singleNote')->withNote($note)->withComments($comments)->withLikes($likes)->withDislikes($dislikes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        //find the note from the slug
        $note = Note::where('slug','=', $slug)->first();
        $categories = Category::all();

        //It is necessary to show all of the data of the categories and for this reason we make the select works of category here to make our view more clearer.
        $cats = array();
        foreach ($categories as $category) {
            $cats[$category->id] = $category->name;
        }

        //Set for tags
        $tags = Tag::all();
        $tags2 = array();
        foreach ($tags as $tag) {
            $tags2[$tag->id] = $tag->name;
        }


        return view('pages.editNote')->withNote($note)->withCategories($cats)->withTags($tags2);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $note = Note::find($id);

        //Validate the note

        if ($request->title == $note->title) {
         $this->validate($request, array(
            'description'   => 'required|min:3',
            'category_id'   => 'required',
            'image'         => 'image',
        ));
     } else {
         $this->validate($request, array(
            'title'         => 'required|min:3|max:190|unique:notes,title',
            'description'   => 'required|min:3',
            'category_id'   => 'required',
            'image'         => 'image',
        ));
     }



        //Store the note

     $note->title = $request->title;
     $note->description = Purifier::clean($request->description);
     $note->category_id = $request->category_id;
     $note->status = $request->status;
     $note->meta_keywords = $request->meta_keywords;
     $note->meta_description = $request->meta_description;



     if ($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = time(). '.'.$image->getClientOriginalExtension();
        $location = public_path('images/note_images/'.$filename);

            //Resize and upload
        Image::make($image)->resize(800, 600)->save($location);

        $oldFileName = $note->image;

        $note->image = $filename;

        Storage::delete($oldFileName);

    }

    $note->save();

    //Sync with tags
    $note->tags()->sync($request->tags);

    Session::flash('success', 'Note has updated successfully');
    return redirect()->route('note.single', $note->slug);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::find($id);

        //Remove all references
        $note->tags()->detach();

        //Delete also from Statistics table
        $statistic = Statistic::where('note_id','=', $note->id)->first();
        $statistic->delete();

        //Delete Comments for this note also
        $comment = Comment::where('note_id','=', $id);
        $comment->delete();



        Storage::delete($note->image);
        $note->delete();
        Session::flash('success', 'Note has deleted successfully');
        return redirect()->route('manage_all_notes');
    }


    /**
     * Change Note Status
     *
     * @param \Illuminate\Http\Request  $request  The request
     *
     * @return void manage_all_notes page
     */
    public function changeNoteStatus(Request $request){

        $note = Note::where('id','=', $request->id)->first();
        if ($note->status == 0) {
            $note->status = 1;
        }else {
            $note->status = 0;
        }
        $note->save();
        return redirect()->route('manage_all_notes');
    }

    /**
     * LikeNote
     *
     * @param \Illuminate\Http\Request  $request  The request
     * @param <int> $note_id  The note identifier
     * @return <void> ( Giving a like to the note and returns to the note single page )
     */
    public function changeLikeStatus(Request $request, $note_id){

        $likes = DB::table('likes')
        ->where('note_id', $note_id)
        ->where('user_id', Auth::user()->id)
        ->get();

        $note = Note::find($note_id);

        if ($likes->count() > 0){
            //remove the like 
            foreach ($note->likes as $like) {
                $like_id = $like->id;
            }
            DB::table('likes')->where('id', '=', $like_id)->delete();

            return redirect()->route('note.single', $note->slug);
        }else {
            $like = new Like;
            $like->note_id = $note_id;
            $like->user_id = Auth::user()->id;
            $like->save();
            return redirect()->route('note.single', $note->slug);
        }
    }

    /**
     * Dislike Note
     *
     * @param \Illuminate\Http\Request  $request  The request
     * @param <int> $note_id  The note identifier
     * @return <void> ( Giving a Dislike to the note and returns to the note single page )
     */
    public function changeDisLikeStatus(Request $request, $note_id){

        $dislikes = DB::table('dislikes')
        ->where('note_id', $note_id)
        ->where('user_id', Auth::user()->id)
        ->get();

        // $note = DB::table('notes')->where('id', $note_id)->first();
        $note = Note::find($note_id);

        if ($dislikes->count() > 0){
            //remove the dislike 
            foreach ($note->dislikes as $dislike) {
                $dislike_id = $dislike->id;
            }
            DB::table('dislikes')->where('id', '=', $dislike_id)->delete();

            return redirect()->route('note.single', $note->slug);
        }else {
            $dislike = new Dislike;
            $dislike->note_id = $note_id;
            $dislike->user_id = Auth::user()->id;
            $dislike->save();
            return redirect()->route('note.single', $note->slug);
        }
    }



    public function searchNote(Request $request){
        $this->validate($request, array(
            'search' => 'required|max:190'
        ));

        $search = $request->search;
        // $notes = DB::table('notes')
        // ->where('title', 'like', $searchText)
        // ->orWhere('description', 'like', '%'.$searchText.'%')
        // ->get();
        $notes = Note::where('title', 'like', '%'.$search.'%')
        ->orWhere('description', 'like', '%'.$search.'%')
        ->paginate(20);

        return view('pages.search')->withNotes($notes)->withSearch($search);
    }


    public function sendReportNoteRequest(Request $request){
      $this->validate($request, array(
        'email'         => 'required|max:100',
        'description'   => 'required',
        'note_id'       => 'integer'
    ));

      //Store
      $admin_notification = new AdminNotification;
      $admin_notification->email = $request->email;
      $admin_notification->subject = 'Request for reporting a note';
      $admin_notification->note_id = $request->note_id;
      $admin_notification->description = $request->description;
      $admin_notification->save();

      Session::flash('success', 'Your request has received successfully. Wait for some times and admin will see that and take necessary action..');
      return redirect()->route('index');
  }
}
