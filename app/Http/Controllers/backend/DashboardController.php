<?php

namespace App\Http\Controllers\backend;

use App\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index(){
        return view('backend.dashboard');
    }

    public function profile(){
        return view('backend.profile');
    }

    public function search(Request $request){
        $this->validate($request,[
           'keyword' => 'required'
        ]);
        $keyword = $request->keyword;
        $result = Content::withoutGlobalScopes()->where('text_title','LIKE','%'.$keyword.'%')
            ->orderBy('text_title','asc')->paginate(15);
        return view('backend.content',compact('result','keyword'));
    }
}
