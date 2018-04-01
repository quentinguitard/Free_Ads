@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mb-3">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h5>Filters</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('annonce.filter')}}">
                                @csrf
                            <div class="form-group">
                                <label for="title">Joueur</label>
                                <input type="text" class="form-control" id='title' name='title'>
                            </div>
                            <div class="form-group">
                                <label for="category">Catégorie</label>
                                <select class="form-control" name="category" id="category">
                                    <option selected>{{ __('Choisir une catégorie') }}</option>
                                    <option value="gardien">Gardien</option>
                                    <option value="defenseur">Defenseur</option>
                                    <option value="milieu">Milieu</option>
                                    <option value="attaquant">Attaquant</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-outline-dark">
                                    {{ __('Search') }}
                            </button>
                    </form>   
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($annonce as $ad)
        
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                        @if(isset($ad->image['0']->filename))
                <img class="card-img-top" src="/{{ $ad->image['0']->filename }}" alt="Card image cap">
                        @endif
                    <div class="card-body">
                        <a href='{{route('annonce.show', $ad->id)}}'><h5 class="card-title">{{ $ad->title }}</h5></a>
                        <p>{{ $ad->prix}} $</p>
                        <p class="card-text">{{ $ad->content}}</p>
                        <div class="d-flex justify-content-between align-items-center">

                            <div class="btn-group">
                            <a role='button' href='{{route('annonce.show', $ad->id)}}' type="button" class="btn btn-sm btn-outline-secondary">View</h5></a>
                            @if(Auth::user()->id == $ad->user->id)
                                <a role='button' href='{{route('annonce.edit', $ad->id)}}' type="button" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <a role='button' href='{{route('annonce.destroy', $ad->id)}}' type="button" class="btn btn-sm btn-outline-secondary">Delete</a>                                
                            @endif
                            </div>
                            <small class="text-muted">{{ $ad->user->username}}</small>
                        </div>
                    </div>
                </div>
            </div> 
        @endforeach

    </div>
    <div class="container d-flex justify-content-center">
        <div class="mt-4">
                {{ $annonce->links() }}
        </div>
    </div>



</div>

@endsection