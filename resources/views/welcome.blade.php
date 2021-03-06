@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/" method="post" accept-charset="utf-8">
            {{ csrf_field() }}
            <div class="row">
                <div class="form-group col-xs-12">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Title (optional)" value="{{ old('title') }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-12">
                    <label for="code">Code</label>
                    <textarea class="form-control input-sm" name="code" id="code" placeholder="Paste your text here...">{{ old('code') }}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label for="expire">Code expiration</label>
                    <select class="form-control" name="expire" id="expire">
                        <option value="never" selected="selected">Never</option>
                        <option value="10m">10 minutes</option>
                        <option value="1h">1 hour</option>
                        <option value="1d">1 day</option>
                        <option value="1w">1 week</option>
                    </select>
                </div>
                <div class="form-group col-sm-3">
                    <label for="access">Access</label>
                    <select class="form-control" name="access" id="access">
                        <option value="public" selected="selected">Public</option>
                        <option value="unlisted">Unlisted, access with link</option>
                        @if (Auth::check())
                            <option value="private">Private, only me</option>
                        @endif
                    </select>
                </div>
                <div class="form-group col-sm-3">
                    <label for="syntax">Syntax</label>
                    <select class="form-control" name="syntax" id="syntax">
                        <option value="" selected="selected">None</option>
                        <option value="php">php</option>
                        <option value="C">C</option>
                    </select>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="form-group text-center">
                    <button type="submit" id="submit" class="btn btn-outline-success btn-lg">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection