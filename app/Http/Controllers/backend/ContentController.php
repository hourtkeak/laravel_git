<?php

namespace App\Http\Controllers\backend;

use App\Content;
use App\Menu;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DOMDocument;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;

class ContentController extends Controller
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
        $contents = Content::withoutGlobalScopes()
            ->where('delete_statue',0)
            ->orderBy('publish_date','desc')->paginate(15);



        return view('backend.content',compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tagMenus = Menu::all();
        $tagArray1 = [];
        if(isset($tagMenus)) {
            foreach ($tagMenus as $tag) {
                $tagArray1[] = $tag->c_title;
            }
        }
        $tagArray2 = [];
        $tagNames = DB::table('taggable_tags')->select("name")->get();
        if(isset($tagNames)) {
            foreach ($tagNames as $tagName) {
                $tagArray2[] = $tagName->name;
            }
        }
        $tagArray = array_merge($tagArray1,$tagArray2);

        return view('backend.add-edit-content',compact('tagArray'));
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
            'short_desc' => 'required',
            'contents' => 'required',
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:10240',
            'publish_date' => 'required|date',
            'cat_id' => 'required',
            'tag'=>'required'
        ]);
        $content = new Content();
        $content->text_title = $request->title;
        $content->description = $request->short_desc;
        $content->cat_id = $request->cat_id;
        $content->member_id = Auth::user()->id;
        $content->create_date = Carbon::now();
        $content->publish_date = date("Y-m-d H:i:s", strtotime($request->publish_date));
        if($request->publish){
            $content->display = 1;
        }
        if($request->feature){
            $content->feature = 1;
        }
        //for content submission
        $message = $request->contents;
        $dom = new DomDocument();
        @$dom->loadHTML(mb_convert_encoding($message,'HTML-ENTITIES', "UTF-8"));
        $images = $dom->getElementsByTagName('img');
        // foreach <img> in the submited message
        foreach($images as $img){
            $src = $img->getAttribute('src');
            // if the img source is 'data-url'
            if(preg_match('/data:image/', $src)){
                // get the mimetype
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                // Generating a random filename
                $filename = uniqid();
                $filepath = "/img/upload_texteditor/$filename.$mimetype";
                // @see http://image.intervention.io/api/
                $image = Image::make($src)
                    ->encode($mimetype, 100)
                    ->save(base_path($filepath));
                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            } // <!--endif
        } // <!-
        $content->full_text = $dom->saveHTML();
        //for image
        $fileimg=$request->file('photo');
        if(!empty($fileimg)) {
            $name = md5($fileimg->getFilename() . time()) . '.' . $fileimg->getClientOriginalExtension();

            $img = Image::make($fileimg->path());
            //file location
            $largeDes = '/img/uploads/' . $name;
            $smallDes = '/img/thumbs/' . $name;
            //store large image
            $img->save(base_path() . $largeDes,90);
            //store small image
            $img->resize(550, 310,
                function ($constraint) {
                    $constraint->aspectRatio();
                })->save(base_path() . $smallDes);

            $content->media = $name;
        }
        if($content->save()){
            Session::flash('success','Successfully Created!');
        }
        $tags = explode(',',$request->tag);
        $content->tag($tags);

        return redirect(route('backend.content'));
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
        $content = Content::withoutGlobalScopes()->findOrFail($id);
        $tags = Tag::where('article_id',$content->id)->get();

        $tagMenus = Menu::all();
        $tagArray1 = [];
        if(isset($tagMenus)) {
            foreach ($tagMenus as $tag) {
                $tagArray1[] = $tag->c_title;
            }
        }
        $tagArray2 = [];
        $tagNames = DB::table('taggable_tags')->select("name")->get();
        if(isset($tagNames)) {
            foreach ($tagNames as $tagName) {
                $tagArray2[] = $tagName->name;
            }
        }
        $tagArray = array_merge($tagArray1,$tagArray2);

        return view('backend.add-edit-content',compact('content','tags','tagArray'));
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
            'short_desc' => 'required',
            'contents' => 'required',
            'publish_date' => 'required|date',
            'cat_id' => 'required',
            'tag'=>'required'
        ]);
        $content = Content::withoutGlobalScopes()->findOrFail($id);
        $content->text_title = $request->title;
        $content->description = $request->short_desc;
        $content->cat_id = $request->cat_id;
        $content->member_id = Auth::user()->id;
        $content->create_date = Carbon::now();
        $content->publish_date = date("Y-m-d H:i:s", strtotime($request->publish_date));
        if($request->publish){
            $content->display = 1;
        }
        else{
            $content->display = 0;
        }
        if($request->feature){
            $content->feature = 1;
        }
        else{
            $content->feature = 0;
        }
        //for content submission
        $message = $request->contents;
        $dom = new DomDocument();
        @$dom->loadHTML(mb_convert_encoding($message,'HTML-ENTITIES', "UTF-8"));
        $images = $dom->getElementsByTagName('img');
        // foreach <img> in the submited message
        foreach($images as $img){
            $src = $img->getAttribute('src');
            // if the img source is 'data-url'
            if(preg_match('/data:image/', $src)){
                // get the mimetype
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                // Generating a random filename
                $filename = uniqid();
                $filepath = "/img/upload_texteditor/$filename.$mimetype";
                // @see http://image.intervention.io/api/
                $image = Image::make($src)
                    ->encode($mimetype, 100)
                    ->save(base_path($filepath));
                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            } // <!--endif
        } // <!-
        $content->full_text = $dom->saveHTML();
        //for image
        $fileimg=$request->file('photo');
        if(!empty($fileimg)) {
            $this->validate($request,[
                'photo' => 'required|image|mimes:jpeg,jpg,png|max:10240'
            ]);
            $name = md5($fileimg->getFilename() . time()) . '.' . $fileimg->getClientOriginalExtension();
            $img = Image::make($fileimg->path());
            //file location
            $largeDes = '/img/uploads/' . $name;
            $smallDes = '/img/thumbs/' . $name;
            //store large image
            $img->save(base_path() . $largeDes,90);
            //store small image
            $img->resize(550, 310,
                function ($constraint) {
                    $constraint->aspectRatio();
                })->save(base_path() . $smallDes);

            $content->media = $name;
        }
        if($content->save()){
            Session::flash('success','Successfully Created!');
            //loop and insert tag
//            if(count($request->tag)){
//                Tag::withoutGlobalScopes()->where('article_id',$id)->delete();
//                foreach ($request->tag as $tag){
//                    $tagg = new Tag();
//                    $tagg->article_id = $id;
//                    $tagg->tag_cat_id = $tag;
//                    $tagg->save();
//                }
//            }
            $tags = explode(',',$request->tag);
            $content->retag($tags);
        }
        return redirect(route('backend.content'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $content = Content::withoutGlobalScopes()->findOrFail($id);
        $content->delete_statue = 1;
        $content->save();
        return back()->with('success','Successfully Deleted!');
    }


}
