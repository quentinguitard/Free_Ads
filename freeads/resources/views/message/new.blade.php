@extends('layouts.app')

@section('content')
<div class="container">
        <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">{{ __('Send Message') }}</div>
            
                            <div class="card-body">
                            <form method="post" action="{{route('message.post')}}">
                                    @csrf
                                
                                    <div class="form-group row">
                                        <label for="username" class="col-md-2 col-form-label text-md-right">{{ __('Username') }}</label>
            
                                        <div class="col-md-9">
                                            <input id="username" type="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>
                                            @if ($errors->has('username'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('username') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
            
            
            
                                    <div class="form-group row">
                                        <label for="subject" class="col-md-2 col-form-label text-md-right">{{ __('Subject') }}</label>
            
                                        <div class="col-md-9">
                                            <input id="subject" type="text" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject" value="{{ old('subject') }}">
                                            @if ($errors->has('subject'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('subject') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
            
            
            
                                    <div class="form-group row">
                                        <label for="content" class="col-md-2 col-form-label text-md-right">{{ __('Message') }}</label>
            
                                        <div class="col-md-9">
                                            <textarea rows='5' id="content" type="content" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" value="{{ old('content') }}" required>
                                            </textarea>
                                            @if ($errors->has('content'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('content') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
            
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-2">
                                            <button type="submit" class="btn btn-dark">
                                                {{ __('Send') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>

@endsection