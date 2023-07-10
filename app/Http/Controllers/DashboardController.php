<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Topic::with(['posts.comments'])->get();
        // dd($data->toArray());
        $comments = [];
        foreach ($data as $topic) {
            $totalComments = $topic->posts->sum(function ($post) {
                return $post->comments->count();
            });
            $comments[$topic->id] = $totalComments;
        }

        return view('dashboard', ['data' => $data, 'comments' => $comments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
