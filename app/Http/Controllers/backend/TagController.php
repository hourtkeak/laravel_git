<?php

namespace App\Http\Controllers\backend;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Cviebrock\EloquentTaggable\Services\TagService;
use Illuminate\Support\Facades\Session;

class TagController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $tags = DB::table('taggable_tags')->paginate(10);
        return view('backend.tag',compact('tags'));
    }

    public function create() {
        return view('backend.add-edit-tag');
    }

    public function store(Request $request){
        $this->validate($request,['title'=>'required|string']);
        $tag = app(TagService::class)->findOrCreate($request->title);
        Session::flash('success','Successfully Created!');
        return redirect(route('backend.tag'));
    }
    public function destroy($id) {
        DB::table('taggable_tags')->where('tag_id',$id)->delete();
        Session::flash('success','Successfully Deleted!');
        return back();
    }
    public function edit($id){
        $tag = \Cviebrock\EloquentTaggable\Models\Tag::where('tag_id', $id)->firstOrFail();
        return view('backend.add-edit-tag',compact('tag'));
    }
    public function update(Request $request, $id){
        $tag = \Cviebrock\EloquentTaggable\Models\Tag::where('tag_id', $id)->firstOrFail();
        if($tag) {
            $tag->name = $request->title;
            $tag->normalized = mb_strtolower($request->title);
            $tag->save();
            Session::flash('success','Successfully Updated!');
        }

        return redirect(route('backend.tag'));
    }
}
