<?php

namespace App\Http\Controllers\backend;

use App\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','checkAdmin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.menu');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.add-edit-menu');
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
            'ordering' => 'required|integer'
        ]);
        $menu = new Menu();
        if($request->display){
            $menu->c_is_show = 1;
        }
        else{
            $menu->c_is_show = 0;
        }
        $menu->c_title = $request->title;
        $menu->ordering = $request->ordering;
        if($menu->save()){
            Session::flash('success','Successfully Created');
            return redirect(route('backend.menu'));
        }

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
        $menu = Menu::findOrFail($id);
        return view('backend/add-edit-menu',compact('menu'));
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
            'ordering' => 'required|integer'
        ]);
        $menu = Menu::findOrFail($id);
        if($request->display){
            $menu->c_is_show = 1;
        }
        else{
            $menu->c_is_show = 0;
        }
        $menu->c_title = $request->title;
        $menu->ordering = $request->ordering;
        if($menu->save()){
            Session::flash('success','Successfully Updated');
            return redirect(route('backend.menu'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete_statue = 1;
        $menu->save();
        return back()->with('success','Successfully Deleted!');
    }
}
