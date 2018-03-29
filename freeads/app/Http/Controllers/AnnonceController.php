<?php

namespace App\Http\Controllers;

use App\Annonce;
use App\User;
use App\Image;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $annonce = Annonce::latest()->paginate(9);
        return view('annonce.index', compact('annonce'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('annonce.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Annonce $annonce)
    {
        $this->validate(request(), [
            'title' => 'required|min:2|max:50',
            'content' => 'required|max:255',
            'prix' => 'required|integer',
            // 'images' => 'array',
            // 'images.*' => 'image',
        ]);
    
//            dd($request->all());
            
        $annonce = auth()->user()->publishAnnonce(new Annonce([
            'title'=> $request->title,
            'content' => $request->content,
            'prix' => $request->prix,
        ]));     
        if(isset($request->images)){
            foreach ($request->images as $image) {
                if ($image->isValid()) {
    
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('images', $filename, 'public');
    
                    $annonce->publishImages(new Image([
                        'filename' => 'storage/images/'.$filename,
                    ]));
    
                }
            }
        }

        return redirect('annonce');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $annonce = Annonce::find($id);

        return view('annonce.show', [
            'annonce' => $annonce
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function edit(Annonce $annonce)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Annonce $annonce)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function destroy(Annonce $annonce)
    {
        //
    }
}
