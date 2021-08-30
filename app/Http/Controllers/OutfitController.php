<?php

namespace App\Http\Controllers;

use App\Models\Outfit;
use App\Models\Master;
use Illuminate\Http\Request;
use Validator;

class OutfitController extends Controller
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
    public function index(Request $request)
    {   
        if($request->master_id == 'all') {
            $outfits = Outfit::orderBy('type')->get();
            $masters = Master::orderBy('surname')->get();
        } elseif ($request->master_id) {
            $outfits = Outfit::where('master_id', $request->master_id)->orderBy('type')->get();
            $masters = Master::orderBy('surname')->get();
        } else {
            $outfits = Outfit::orderBy('type')->get();
            $masters = Master::orderBy('surname')->get();
        }

        return view('outfit.index', [
            'outfits' => $outfits,
            'master_id' => $request->master_id ?? 'all',
            'masters' => $masters
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $masters = Master::orderBy('surname')->get();
        return view('outfit.create', ['masters' => $masters]);

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
           'outfit_type' => ['required', 'min:2', 'max:50', 'regex:/^[a-zA-Z]+$/'],
           'outfit_color' => ['required', 'min:2', 'max:50', 'regex:/^[a-zA-Z]+$/'],
           'outfit_size' => ['required', 'integer', 'min:1', 'max:199'],
           'master_id' => ['required', 'integer']	
       ],
        [
        'outfit_type.regex' => 'The outfit type must be in letters only',
        'outfit_color.regex' => 'The outfit color must be in letters only'
        ]
       );

       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }

        $outfit = new Outfit;
        $outfit->type = ucfirst(strtolower($request->outfit_type));
        $outfit->color = ucfirst(strtolower($request->outfit_color));
        $outfit->size = $request->outfit_size;
        $outfit->master_id = $request->master_id;
        $outfit->save();
        return redirect()->route('outfit.index')->with('success_message', 'A new outfit was added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function show(Outfit $outfit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function edit(Outfit $outfit)
    {
        $masters = Master::orderBy('surname')->get();
        return view('outfit.edit', ['outfit' => $outfit, 'masters' => $masters]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outfit $outfit)
    {   
        $validator = Validator::make($request->all(),
       [
           'outfit_type' => ['required', 'min:2', 'max:50', 'regex:/^[a-zA-Z]+$/'],
           'outfit_color' => ['required', 'min:2', 'max:50', 'regex:/^[a-zA-Z]+$/'],
           'outfit_size' => ['required', 'integer', 'min:1', 'max:199'],
           'master_id' => ['required', 'integer']	
       ],
        [
        'outfit_type.regex' => 'The outfit type must be in letters only',
        'outfit_color.regex' => 'The outfit color must be in letters only'
        ]
       );

       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }


        $outfit->type = ucfirst(strtolower($request->outfit_type));
        $outfit->color = ucfirst(strtolower($request->outfit_color));
        $outfit->size = $request->outfit_size;
        $outfit->master_id = $request->master_id;
        $outfit->save();
        return redirect()->route('outfit.index')->with('success_message', 'Outfit information was successfully edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outfit $outfit)
    {
        $outfit->delete();
        return redirect()->route('outfit.index')->with('success_message', 'The information about the outfit was deleted.');
    }
}
