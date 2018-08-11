<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::user()->role_id > 2){
            return redirect()->route('users.show', ['id'=>Auth::user()->id]);
        }

        if(Auth::user()->role_id == 1){
            $users = User::orderBy('role_id')->paginate(4);
        }else{
            $users = User::where('role_id', '>', 2)->orderBy('role_id')->paginate(4);
        }


        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(Auth::user()->role_id > 2){
            return redirect()->back();
        }

        if(Auth::user()->role_id == 1){
            $roles = Role::pluck('name', 'id')->all();
        }

        return view('users.create', compact('roles'));
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
        if(trim($request->password) == ""){
            return $request->except('password');
        }else{
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }

        User::create($input);

        return redirect('/users')->with('status','Profile added!');

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
        if(Auth::user()->role_id > 2){
            return redirect('/home');
        }

        $user = User::findOrFail($id);

        if($user->role_id == 1){
            if(Auth::user()->role_id > 1){
                return redirect('/home');
            }
        }

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);

        if(Auth::user()->role_id == 1){
            $roles = Role::pluck('name', 'id')->all();
        }

        return view('users.edit', compact('user', 'roles'));
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
        //
//        $user = User::findOrFail($id);
//        var_dump($request->all());

        $user = User::findOrFail($id);

        if(trim($request->password) == ""){
            return $request->except('password');
        }else{
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }


        $user->update($input);
        return redirect('/users')->with('status', 'Profile updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/users')->with('status', 'User deleted successfully!');
    }
}
