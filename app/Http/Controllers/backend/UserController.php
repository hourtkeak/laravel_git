<?php

namespace App\Http\Controllers\backend;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth','checkAdmin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('backend.user',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.add-edit-user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $user = User::findOrFail($id);
        if($user){
            return view('backend.add-edit-user',compact('user'));
        }
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'level' => 'required'
        ]);
        $user = User::findOrFail($id);
        if($request->password){
            $this->validate($request,[
                'password' => 'required|string|min:6|confirmed'
            ]);
            $user->password = bcrypt($request->password);

        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = $request->level;
        if($user->save()){
            Session::flash('success','Successfully Updated!');
            return redirect(route('backend.user'));
        }
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        Session::flash('success','Successfully Deleted!');
        return back();
    }

    public function profile(Request $request,$id){

        if($id != Auth::user()->id){
            return 'hello';
        }
        else{
            $this->validate($request,[
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
            ]);
            $user = User::findOrFail($id);
            if($request->password){
                $this->validate($request,[
                    'password' => 'required|string|min:6|confirmed'
                ]);
                $user->password = bcrypt($request->password);

            }
            $user->name = $request->name;
            $user->email = $request->email;
            if($user->save()){
                Session::flash('success','Successfully Updated!');
                return redirect(route('backend.profile'));
            }
        }
    }
}
