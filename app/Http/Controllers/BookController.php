<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function create()
    {
        $authors = Author::query()->orderBy('name')->get();
        $publishers = Publisher::query()->orderBy('name')->get();

        return view('books.create', compact('authors', 'publishers'));
    }

    public function store(Request $request)
    {
        $book = Book::query()->create($request->only([
            'title',
            'edition',
            'copyright',
            'language',
            'pages',
            'author_id',
            'publisher_id',
        ]));

        return redirect()->route('books.show', $book->id);
    }

    public function index()
    {
        $books = Book::query()->orderBy('title')->get();

        return view('books.index', compact('books'));
    }

    public function edit(int $id)
    {
        $book = Book::query()->findOrFail($id);
        $authors = Author::query()->orderBy('name')->get();
        $publishers = Publisher::query()->orderBy('name')->get();

        return view('books.edit', compact('book', 'authors', 'publishers'));
    }

    public function update(int $id, Request $request)
    {
        $book = Book::query()->findOrFail($id);

        $book->update($request->only([
            'title',
            'edition',
            'copyright',
            'language',
            'pages',
            'author_id',
            'publisher_id',
        ]));

        return redirect()->route('books.show', $book->id);
    }

    public function show(int $id)
    {
        $book = Book::query()
            ->with(['author', 'publisher'])
            ->findOrFail($id);

        return view('books.show', compact('book'));
    }
}
