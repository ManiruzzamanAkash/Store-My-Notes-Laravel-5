<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
use App\AdminNotification;
use App\Note;
use App\Country;
use Image;
use Session;

class UserController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth', ['except' => ['singleUser', 'userLogout', 'sendBanRemoveRequest']]);
	}


	public function singleUser($username){
		$user = User::where('username','=', $username)->first();

    if ($user) {
      $notes = Note::where('user_id','=', $user->id)->orderBy('updated_at', 'desc')->paginate(5);
      return view('pages.singleUser')->withUser($user)->withNotes($notes);
    }else {
      return redirect()->route('index');
    }

  }


   /**
     * User Logout
     *
     * @return void Redirect user to the home page
     */
   public function userLogout(Request $request)
   {
   	$this->guard('web')->logout();
   	return redirect()->route('index');
   }


   public function edit($username){
    if (Auth::user()->username == $username) {
      //find the user's everything
      $user = DB::table('users')
      ->where('username', $username)
      ->first();

      // $countries = Country::all();
      $countries = DB::table('countries')
      ->orderBy('name', 'asc')
      ->get();

      $cs = array();
      foreach ($countries as $country) {
        $cs[$country->id] = $country->name;
      }
      
      return view('pages.editUser')->withUser($user)->withCountries($cs);
    }else {
      $user = DB::table('users')
      ->where('username', $username)
      ->first();
      if ($user) {
        return redirect()->route('user.single', $username);
      }else {
        return redirect()->route('index');
      }
      
    }
  }

  public function update(Request $request, $id){

    // $user = DB::table('users')
    // ->where('id', $id)
    // ->first();
    $user = User::find($id);

    //validate the user data
    if ($request->username == $user->username) {
      $this->validate($request, array(
        'name'            => 'required|min:3|max:190',
        'username'        => 'required|min:3|max:190',
        'image'           => 'nullable|image',
        'country_id'      => 'nullable|integer',
        'bio_title'       => 'nullable|min:3|max:190',
        'bio_description' => 'nullable|min:3',
        'website'         => 'nullable|min:3|max:190|url',
        'organization'    => 'nullable|min:3|max:190'
      ));
    }else {
      $this->validate($request, array(
        'name'            => 'required|min:3|max:190',
        'username'        => 'required|min:3|max:190|unique:users',
        'image'           => 'nullable|image',
        'country_id'      => 'nullable|integer',
        'bio_title'       => 'nullable|min:3|max:190',
        'bio_description' => 'nullable|min:3|max:190',
        'website'         => 'nullable|min:3|max:190|url',
        'organization'    => 'nullable|min:3|max:190'
      ));
    }


    if ($request->hasFile('image')) {
      $image = $request->file('image');
      $filename = $request->username. '.'.$image->getClientOriginalExtension();
      $location = public_path('images/users/'.$filename);

            //Resize and upload
      Image::make($image)->resize(500, 500)->save($location);

      $oldFileName = $user->image;

      $user->image = $filename;

      //Storage::delete($oldFileName);

    }


    //Store Now
    $user->name = $request->name;
    $user->username = $request->username;
    $user->country = $request->country_id;
    $user->bio_title = $request->bio_title;
    $user->bio_description = $request->bio_description;
    $user->website = $request->website;
    $user->organization = $request->organization;
    $user->save();
    $request->session()->flash('success', 'Your Information has updated successfully');
    return redirect()->route('user.single', $user->username);
  }

  public function sendBanRemoveRequest(Request $request){
      $this->validate($request, array(
        'email'  => 'required|max:100',
        'description' => 'required',
      ));

      //Store
      $admin_notification = new AdminNotification;
      $admin_notification->email = $request->email;
      $admin_notification->subject = 'Request for remove banned user';
      $admin_notification->description = $request->description;
      $admin_notification->save();

      Session::flash('success', 'Your request has received successfully. Wait for some times and admin will see that and take necessary action..');
      return redirect()->route('index');
  }
}
