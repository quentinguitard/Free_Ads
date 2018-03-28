@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                        <div class="col-md-6">
                        <p class="mt-2">{{ $user->username }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <p class="mt-2">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Firstname') }}</label>

                        <div class="col-md-6">
                            <p class="mt-2">{{ $user->firstname }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Lastname') }}</label>

                        <div class="col-md-6">
                            <p class="mt-2">{{ $user->lastname }}</p>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a href="{{ route('profile.edit', ['id' => $user->id]) }}" class="btn btn-outline-dark">
                                {{ __('Edit') }}
                            </a>
                            <a href="{{ route('profile.destroy', ['id' => $user->id]) }}" class="btn btn-outline-dark">
                                {{ __('Supprimer') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
