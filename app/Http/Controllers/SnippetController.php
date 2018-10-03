<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use \App\Snippet;
use \Auth;
use Illuminate\Support\Facades\Input;

class SnippetController extends Controller
{
    public function index()
    {
        $snippets = Snippet::latest()->take(10)->get();
        return view('welcome')->withSnippets($snippets);
    }

    public function submit(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'max:255',
            'code' => 'max:65523',
            'access' => 'required|in:public,unlisted,private',
            'syntax' => 'max:255',
        ]);

        $title = (empty(trim($validatedData['title']))) ? 'Untitled' : $validatedData['title'];

        switch (Input::get('expire')) {
            case '10m':
                $expiration = Carbon::now()->addMinutes(10);
                break;
            case '1h':
                $expiration = Carbon::now()->addHour();
                break;
            case '1d':
                $expiration = Carbon::now()->addDay();
                break;
            case '1w':
                $expiration = Carbon::now()->addWeek();
                break;
            default:
                $expiration = null;
        }

        $uuid = uniqid();
        $existingSnippet = Snippet::where('uuid', $uuid)->first();
        while (!is_null($existingSnippet)) {
            $uuid = uniqid();
            $existingSnippet = Snippet::where('uuid', $uuid)->first();
        }

        Snippet::create([
            'userId' => (Auth::check()) ? Auth::id() : null,
            'title' => $title,
            'code' => $validatedData['code'],
            'expiration' => $expiration,
            'access' => $validatedData['access'],
            'syntax' => $validatedData['syntax'],
            'uuid' => $uuid
        ]);

        return redirect('/' . $uuid);
    }
}
