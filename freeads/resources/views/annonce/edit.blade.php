@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Publier une Annonce') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('annonce.update', $annonce->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row -flex justify-content-center mt-3">
                                @foreach($annonce->image as $image)
                                <div class="col-3">
                                    <img class="card-img-top" src="/{{ $image->filename }}" alt="" max-height='300px'>
                                <a href="{{route('image.destroy', $image->id)}}">Suprimer</a>
                                </div>
                                @endforeach
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Titre') }}</label>

                            <div class="col-md-6">
                            <input id="title" type="text" value='{{$annonce->title}}' class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="prix" class="col-md-4 col-form-label text-md-right">{{ __('Prix') }}</label>

                            <div class="col-md-6">
                                <input id="prix" type="text" value='{{$annonce->prix}}' class="form-control{{ $errors->has('prix') ? ' is-invalid' : '' }}" name="prix" value="{{ old('prix') }}" required>

                                @if ($errors->has('prix'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('prix') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Description de l\'annonce') }}</label>

                            <div class="col-md-6">
                                <textarea id="content" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" required>{{$annonce->content}}'</textarea>
                                @if ($errors->has('content'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                                @endif

                                <input type="file" name="images[]" multiple />

                                @if ($errors->has('images'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('images') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection