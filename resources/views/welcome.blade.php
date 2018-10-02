@extends('layouts.app')

@section('content')
    <div class="title m-b-md">
        Laravel
    </div>

    @foreach ($snippets as $snippet)
        <a href="{{ $snippet->uuid }}">{{ $snippet->title }}</a>
    @endforeach
@endsection