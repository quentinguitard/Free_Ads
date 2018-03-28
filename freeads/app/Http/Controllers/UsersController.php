<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        if(\Auth::id() == $id){
        $user = User::where('id', $id)->first();
        return view('auth.show', [
            'user' => $user,
        ]);
        }
        else{
            return redirect('home')->with('error','You cannot preform this action');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(\Auth::id() == $id){
            $user = User::where('id', $id)->first();
            return view('auth.edit', [
                'user' => $user,
            ]);
        }
        else {
            return redirect('/home')->with('error', 'You are not authorized !');
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
        $user = User::where('id', $id)->first();
        $validateArray = [
            
            'firstname' => 'string|max:10',
            'lastname' => 'string|max:10',
        ];
        if($request->email != $user->email)
        {
            $validateArray['email'] = 'string|email|max:100|unique:users|required'; 
        }
        if($request->username != $user->username)
        {
            $validateArray['username'] = 'string|max:100|unique:users|required';
        }
        $this->validate(request(), $validateArray);


        if(\Auth::id() == $id){
            $user = User::find($id);
            $user->username = $request->username;
            $user->email = $request->email;
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->save();
            return redirect(route('profile.show', ['id' => $id]));
        }
        else{
            return redirect('home')->with('error','You cannot preform this action');
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
        if(\Auth::id() == $id){
            $user = User::find($id);
            $user->delete();
            return redirect('home')->with('success', 'Your account has been deleted');
        }
        
    }
}
