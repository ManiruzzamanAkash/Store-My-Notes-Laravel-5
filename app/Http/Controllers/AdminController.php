<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Tag;
use App\Note;
use App\Comment;
use App\User;
use App\Settings;
use Image;
use Session;
use Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.admin_index');
    }

    public function manageUsers(){
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.pages.manage-users')->withUsers($users);
    }

    public function settingsPage(){
        $settings = Settings::find(1);  //In settings page only one id = 1
        return view('admin.pages.admin-settings')->withSettings($settings);
    }

    public function manageNotesPage(){
        $notes = Note::orderBy('id', 'desc')->paginate(20);  
        return view('admin.pages.manage-notes')->withNotes($notes);
    }



    public function settingsUpdate(Request $request, $id = 1){
        //Validate the data's
        $this->validate($request, array(
            'site_title'  => 'required|max:100',
            'site_description'  => 'nullable|max:500',
            'site_description_visible' => 'nullable|integer',
            'site_logo' => 'nullable|image',
            'home_min_note' => 'required|integer',
            'site_meta_keywords' => 'nullable|max:190',
            'site_meta_description' => 'nullable'
        ));

        $settings = Settings::find(1);

        // $settings->id = 1;
        $settings->site_title = $request->site_title;
        $settings->site_description = $request->site_description;
        if (($request->site_description_visible == NULL)) {
            $settings->site_description_visible = 0;
        }else {
            $settings->site_description_visible = 1;
        }

        $settings->home_min_note = $request->home_min_note;
        $settings->site_meta_keywords = $request->site_meta_keywords;
        $settings->site_meta_description = $request->site_meta_description;
        $settings->admin_id = Auth::user()->id;

        if ($request->hasFile('site_logo')) {
            $image = $request->file('site_logo');
            $filename = 'logo.'.$image->getClientOriginalExtension();
            $location = public_path('images/'.$filename);

            //Resize and upload
            Image::make($image)->resize(400, 400)->save($location);
            $settings->site_logo = $filename;
        }

        $settings->save();

        Session::flash('success', 'Settings has updated successfully');
        return redirect()->route('admin.settings');
    }

    public function changeActiveStatus($id){
        $user = User::find($id);
        if ($user->is_active == 0) {
            $user->is_active = 1;
        }else {
            $user->is_active = 0;
        }
        $user->save();
        return redirect()->route('admin.manage_users');
    }


    public function getUserAsJson(Request $request) {
        $query = $request->get('name','');
        
        $users=User::where('name','LIKE','%'.$query.'%')->get();
        
        $data=array();
        foreach ($users as $user) {
            $data[]=array('value'=>$user->name,'id'=>$user->id);
        }
        if(count($data)){
            return $data;
        }else{
            return ['value'=>'No Result Found','id'=>''];
        }
    }


}
