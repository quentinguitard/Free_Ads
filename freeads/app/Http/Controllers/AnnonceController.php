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
        ]);
    
//            dd($request->all())


        if($request->category == 'Choisir une catégorie'){
            $request->category = null;
        };
                    
        $annonce = auth()->user()->publishAnnonce(new Annonce([
            'title'=> $request->title,
            'content' => $request->content,
            'prix' => $request->prix,
            'category' => $request->category,
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
        return redirect('annonce')->with('success', 'Votre annonce a bien été crée');
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
    public function edit($id)
    {
        $annonce = Annonce::find($id);

        if(\Auth::user()->id == $annonce->user->id){

            return view('annonce.edit', [
                'annonce' => $annonce
            ]);
        }        
        else {
            return redirect('annonce')->with('error', 'You are not authorized !');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'title' => 'required|min:2|max:50',
            'content' => 'required|max:255',
            'prix' => 'required|integer',
        ]);

        if($request->category == 'Choisir une catégorie'){
            $request->category = null;
        }
        $annonce = Annonce::find($id);
        if(\Auth::user()->id == $annonce->user->id){
            $annonce->title = $request->title;
            $annonce->prix = $request->prix;
            $annonce->content = $request->content;
            $annonce->category = $request->category;
            $annonce->update();
    
            if(isset($request->images)){
                foreach ($request->images as $image) {
                    if ($image->isValid()) {
        
                        $filename = time() . '.' . $image . $image->getClientOriginalExtension();
                        $image->storeAs('images', $filename, 'public');
        
                        $annonce->publishImages(new Image([
                            'filename' => 'storage/images/'.$filename,
                        ]));
        
                    }
                }
            }
    
            return redirect("annonce/{$id}")->with('success', 'Votre annonce a été mise a jour');
        }
        else {
            return redirect('annonce')->with('error', 'You are not authorized !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $annonce = Annonce::find($id);
        if(\Auth::user()->id == $annonce->user->id){
            $annonce->delete();

            return redirect('annonce')->with('success', 'Votre annonce a été supprimer');
        }
        else {
            return redirect('annonce')->with('error', 'You are not authorized !');
        }

    }

    public function filterSearch(Request $request)
    {
        if($request->category == 'Choisir une catégorie'){
            //$request->category = null;
            $annonce = Annonce::latest()
            ->where('title', 'LIKE', $request->title)
            ->paginate(9);
        }else {
            $annonce = Annonce::latest()
            ->where('title', 'LIKE', $request->title)
            ->where('category', 'LIKE', $request->category)
            ->paginate(9);
        }

        //dd($annonce);
        return view('annonce.index', compact('annonce'));
        
    }
}
