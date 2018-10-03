@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Access</th>
                            <th>Created</th>
                            <th>Expiration</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($snippets as $snippet)
                            <tr>
                                <td><a href="{{ $snippet->uuid }}">{{ $snippet->title }}</a></td>
                                <td>{{ $snippet->access }}</td>
                                <td>{{ $snippet->created_at }}</td>
                                <td>{{ $snippet->expiration }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No snippets found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $snippets->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
