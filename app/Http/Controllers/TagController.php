<?php

namespace App\Http\Controllers;

use App\Tag;
use App\User;
use App\Http\Requests\StoreTag;
use App\Http\Requests\UpdateTag;

class TagController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'accept']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::with(['users', 'clients'])->paginate(15);

        return view('tags.index')->with('tags', $tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', User::class);

        return view('tags.create')->with('tag', new Tag);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTag  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTag $request)
    {
        Tag::create($request->validated());

        return back()->with('status', 'The technology was successfully created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag $tag
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Tag $tag)
    {
        $this->authorize('edit', $tag);

        return view('tags.edit')->with('tag', $tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTag  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTag $request, Tag $tag)
    {
        $tag->update($request->validated());

        return back()->with('status', 'The technology was successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag $tag
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Tag $tag)
    {
        $this->authorize('delete', $tag);

        $tag->delete();

        return redirect()->route('tags.create')->with('status', 'The technology was successfully deleted!');
    }
}
