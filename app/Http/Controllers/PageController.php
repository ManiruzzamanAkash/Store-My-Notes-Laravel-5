<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getIndex(){
    	return view('pages.index');
    }

    public function contactPage(){
    	return view('pages.contact');
    }

    public function privacyPage(){
    	return view('pages.privacy');
    }

    public function termsPage(){
    	return view('pages.terms');
    }

    public function reportPage(){
    	return view('pages.report');
    }
}
