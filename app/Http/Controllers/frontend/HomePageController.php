<?php

namespace App\Http\Controllers\frontend;

use App\Content;
use App\Menu;
use App\Slide;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class HomePageController extends Controller
{
    public function index(Request $request){

        // for sending user who clicked from facebook share
        // to new site url
        $id = 0;
        $news_id = 0;
        $url = $request->fullUrl();
        $getFullLength = strlen($url);
        if($getFullLength >= 40){
            //get article_id from facebook shared link
            $article_id = strpos($url,'page_id');
            $sub_article_id = substr($url, $article_id+8,1);
            //get news_id from facebook shared link
            $expolde_pageId = explode("&", $url);
            $expolde_newsId = explode("?", $expolde_pageId[0]);
            $expolde_newsId =  explode("=", $expolde_newsId[1]);

            $id = $sub_article_id;
            $news_id = $expolde_newsId[1];

            return redirect("/page/$id/$news_id");
        }

        //get slides
        $slides = Slide::limit(5)->orderBy('ordering','asc')->get();

        //get top 4 news next to the slide
        $slide_contents = Content::where('feature',1)
            ->limit(4)
            ->get();

        //remove when production
        //get Menus for loop
        $catTitles = Menu::where('delete_statue',0)
            ->orderBy('ordering','asc')
            ->limit(4)->get();
        $allNews = [];
        foreach ($catTitles as $catTitle){
            $news = Content::where('cat_id',$catTitle->c_id)->limit(5)->get();
            $allNews[$catTitle->c_id] = $news;
        }
        return view('frontend.home',compact('slides','slide_contents','catTitles','allNews'));
    }

    public function page($id){
        //get menu title
        $menu = Menu::findOrFail($id);

        //get all content in the category with limit 15
        $contents = Content::where('cat_id',$menu->c_id)
            ->orderBy('id','desc')
            ->paginate(15);
        return view('frontend.page',compact('menu','contents'));
    }

    public function pageDetail($id,$news_id){
        //find the content to display in detail
        $content = Content::where('id',$news_id)
            ->where('cat_id',$id)
            ->first();

        //if id not found, return to another page
        if(!$content){
            return view('frontend.page');
        }

        //add count
        $this->addCount($content->id);

//        if($content->tagList) {
//            //get related content for the detail page
//            $relatedContents = $content::withAnyTags($content->tagList)->where('id','<>',$news_id)->limit(4)->get();
//        }
        $relatedContents = Content::where('id','<>',$news_id)->where('cat_id',$content->cat_id)->limit(4)->get();


        return view('frontend.detail',compact('content','relatedContents','id'));
    }

    public function tag($tagName){
        if(isset($tagName)){
            $tagName = str_replace('-', ' ', $tagName);
            $tag = DB::table('taggable_tags')->where('name',$tagName)->first();
            $contents_id = [];
            $tagGroup = DB::table('taggable_taggables')->where('tag_id',$tag->tag_id)->get();
            if(count($tagGroup)) {
                foreach ($tagGroup as $tagG) {
                    $contents_id[] = $tagG->taggable_id;
                }
            }
//            $contents = Content::withAllTags($tagName)->paginate(15);
            $contents = Content::whereIn('id', $contents_id)->paginate(15);

            return view('frontend.page',compact('tagName','contents'));
        }
    }

    private function addCount($id){
        if($id){
            //remove space
            $id = trim($id);
            $content = Content::findOrFail($id);
            if($content){
                $content->count++;
                $content->save();
            }
        }
    }

    public function search(Request $request) {
        if($request->keyword) {
            $keyword = trim($request->keyword);
            $contents = Content::withoutGlobalScopes()->where('text_title','LIKE','%'.$keyword.'%')
                ->orderBy('publish_date','desc')->paginate(15);
            return view('frontend.page',compact('keyword','contents'));
        } else {
            return view('frontend.page',compact('keyword','contents'));
        }
    }

    public function ots() {
        return view('frontend.ots');
    }

}
