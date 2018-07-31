<?php

namespace App\Http\Controllers\backend;

use App\Slide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

class SlideController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slide::all();
        return view('backend.slide',compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.add-edit-slide');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'link' => 'required',
            'ordering' => 'required|integer',
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:10240'
        ]);
        $slide = new Slide();
        $slide->s_title = $request->title;
        $slide->link = $request->link;
        $slide->ordering = $request->ordering;

        $fileimg=$request->file('photo');
        if(!empty($fileimg)) {
            $name = md5($fileimg->getFilename() . time()) . '.' . $fileimg->getClientOriginalExtension();
            $img = Image::make($fileimg->path());
            //file location
            $des = '/img/slide/' . $name;
            $img->save(base_path() . $des);
            $slide->s_img = $name;
        }
        if($slide->save()){
            Session::flash('success','Successfully Created!');
        }
        return redirect(route('backend.slide'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slide = Slide::findOrFail($id);
        return view('backend.add-edit-slide',compact('slide'));
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
        $this->validate($request,[
            'title' => 'required',
            'link' => 'required',
            'ordering' => 'required|integer',
        ]);
        $slide = Slide::findOrFail($id);
        $slide->s_title = $request->title;
        $slide->link = $request->link;
        $slide->ordering = $request->ordering;

        $fileimg=$request->file('photo');
        if(!empty($fileimg)) {
            $this->validate($request,[
                'photo' => 'required|image|mimes:jpeg,jpg,png|max:10240'
            ]);
            $name = md5($fileimg->getFilename() . time()) . '.' . $fileimg->getClientOriginalExtension();
            $img = Image::make($fileimg->path());
            //file location
            $des = '/img/slide/' . $name;
            $img->save(base_path() . $des);
            $slide->s_img = $name;
        }
        else{
            $slide->s_img = $request->oldPhoto;
        }
        if($slide->save()){
            Session::flash('success','Successfully Updated!');
        }
        return redirect(route('backend.slide'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Slide::destroy($id);
        return back()->with('success','Successfully Deleted!');
    }
}
