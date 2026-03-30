<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $author = Author::query()->create($request->only([
            'name',
            'nationality',
            'birth_year',
            'fields',
        ]));

        return redirect()->route('authors.show', $author->id);
    }

    public function index()
    {
        $authors = Author::query()->orderBy('name')->get();

        return view('authors.index', compact('authors'));
    }

    public function edit(int $id)
    {
        $author = Author::query()->findOrFail($id);

        return view('authors.edit', compact('author'));
    }

    public function update(int $id, Request $request)
    {
        $author = Author::query()->findOrFail($id);

        $author->update($request->only([
            'name',
            'nationality',
            'birth_year',
            'fields',
        ]));

        return redirect()->route('authors.show', $author->id);
    }

    public function show(int $id)
    {
        $author = Author::query()
            ->with('books')
            ->findOrFail($id);

        return view('authors.show', compact('author'));
    }
}
