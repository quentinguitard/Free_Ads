@extends('layouts.app')

@section('content')
<div class="container">

<a type='button' class='btn btn-outline-dark mb-3' href="{{ route('message.new') }}">New Message</a>
    <table class="table table-striped">
        <thead>
            <tr>
                
                <th scope="col">From</th>
                <th scope="col">Subject</th>
                <th scope="col">Content</th>                
                
            </tr>
        </thead>
        <tbody>
            @foreach($message as $mess)
            
                <tr>
    
                    <td>{{ $mess->user_sent }}</td>
                    <td>{{ $mess->title}}</td>
                    <td>{{ $mess->content}}</td>                
                
                </tr>
            
            @endforeach
        </tbody>
    </table>
</div>

@endsection