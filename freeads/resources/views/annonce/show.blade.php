@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card mb-3">
        <div class="row -flex justify-content-center mt-3">
            @foreach($annonce->image as $image)
            <div class="col-3">

                <img class="card-img-top" src="../{{ $image->filename }}" alt="" max-height='300px'>
            </div>
            @endforeach
        </div>
        <div class="card-body">
            <h5 class="card-title">{{$annonce->title}}</h5>
            <h6 class="card-title">$ {{$annonce->prix}}</h6>
            <p class="card-text">{{$annonce->content}}</p>
            <p class="card-text"><small class="text-muted">{{$annonce->user->username}}</small></p>
            @if(Auth::user()->id == $annonce->user->id)
            <a role='button' href='{{route('annonce.edit', $annonce->id)}}' type="button" class="btn btn-sm btn-outline-secondary">Edit</a>
            <a role='button' href='{{route('annonce.destroy', $annonce->id)}}' type="button" class="btn btn-sm btn-outline-secondary">Delete</a>                                            
            @endif
        </div>
    </div>

</div>

@endsection