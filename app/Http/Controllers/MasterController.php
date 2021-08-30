<?php

namespace App\Http\Controllers;

use App\Models\Master;
use Illuminate\Http\Request;
use Validator;

class MasterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $masters = Master::orderBy('surname')->get();
        return view('master.index', ['masters' => $masters]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(),
       [
           'master_name' => ['required', 'min:2', 'max:64', 'regex:/^[a-zA-Z]+$/'],
           'master_surname' => ['required', 'min:2', 'max:64', 'regex:/^[a-zA-Z]+$/'],
       ],
        [
        'master_name.regex' => 'Master name must be in letters only',
        'master_surname.regex' => 'Master surname must be in letters only'
        ]
       );

       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }

        $master = new Master;
        $master->name = ucfirst(strtolower($request->master_name));
        $master->surname = ucfirst(strtolower($request->master_surname));
        $master->save();
        return redirect()->route('master.index')->with('success_message', 'A new master was added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function show(Master $master)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function edit(Master $master)
    {
        return view('master.edit', ['master' => $master]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Master $master)
    {   
        $validator = Validator::make($request->all(),
       [
           'master_name' => ['required', 'min:2', 'max:64', 'regex:/^[a-zA-Z]+$/'],
           'master_surname' => ['required', 'min:2', 'max:64', 'regex:/^[a-zA-Z]+$/'],
       ],
        [
        'master_name.regex' => 'Master name must be in letters only',
        'master_surname.regex' => 'Master surname must be in letters only'
        ]
       );

       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }
       
        $master->name = ucfirst(strtolower($request->master_name));
        $master->surname = ucfirst(strtolower($request->master_surname));
        $master->save();
        return redirect()->route('master.index')->with('success_message', 'Master information was successfully edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master  $master
     * @return \Illuminate\Http\Response
     */
    public function destroy(Master $master)
    {
        if($master->masterOutfits->count() === 0){
            $master->delete();
            return redirect()->route('master.index')->with('success_message', 'The information about the master was deleted.');
        }
        return redirect()->back()->with('info_message', 'Delete is impossible, because Master has outfit');
    }
}
