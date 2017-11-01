<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
use App\AdminNotification;

class AdminNotificationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $admin_notifications = DB::table('admin_notifications')
        ->orderBy('is_seen', 'asc')
        ->orderBy('created_at', 'asc')
        ->paginate(20);
        
        return view('admin.pages.notifications')->withNotifications($admin_notifications);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $notification = AdminNotification::find($id);
        

        $user = User::where('email', $notification->email)->first();

        //Make notification viewed
        $notification->is_seen = 1;
        $notification->seen_by = Auth::user()->id;
        $notification->save();

        return view('admin.pages.notifications-single')->withNotification($notification)->withUser($user);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
