@extends('layouts.app')

@section('content')

<div class="container">


<div class="row">
    @foreach($annonce as $ad)
    
        <div class="col-md-4">
            <div class="card mb-4 box-shadow">
                    @if(isset($ad->image['0']->filename))
            <img class="card-img-top" src="{{ $ad->image['0']->filename }}" alt="Card image cap">
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
                        @endif
                        </div>
                        <small class="text-muted">{{ $ad->user->username}}</small>
                    </div>
                </div>
            </div>
        </div> 
    @endforeach
</div>

</div>

@endsection