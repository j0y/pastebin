@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css">
@endsection

@section('script')
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script>
        hljs.initHighlightingOnLoad();
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-11">
                <h3>{{ $snippet->title }}</h3>
            </div>

        </div>
        <div class="row">
            <div class="col-xs-12">
                <ul class="list-inline" style="color:#999FA4;">
                    <li>Created by: <i>{{ $username }}</i></li>
                    <li>Created at: <i>{{ $snippet->created_at }}</i></li>
                    <li>Expires: <i> {{(is_null($snippet->expiration)) ? "Never" : $snippet->expiration }}</i></li>
                    <li>Access: <i> {{ $snippet->access }}</i></li>
                    <li>Syntax: <i> {{ is_null($snippet->syntax) ? "Plain-text" : $snippet->syntax }} </i></li>
                </ul>
            </div>
        </div>

        <div class="row" style="margin-bottom:20px;">
            <div class="col-sm-12">
                <pre><code class="{{ $snippet->syntax }}">{{ $snippet->code }}</code></pre>
            </div>
        </div>
    </div>
@endsection